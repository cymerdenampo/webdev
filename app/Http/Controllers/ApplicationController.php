<?php

namespace App\Http\Controllers;

use App\Mail\ApprovedEmail;
use App\Mail\RejectedEmail;
use App\Payment;
use App\SellerFile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Response;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            return datatables()->of
            (
                SellerFile::where('id', '<>', 0)
            )
                ->addColumn('action', function ($row) {
                    if ($row['status'] == 'pending') {
                        return '
                        <button data-id="' . $row['id'] . '" class="btn btn-primary edit-row" data-toggle="modal" >Manage</button>
                        ';
                    }
                    if ($row['status'] == 'rejected') {
                        return '
                        <button data-id="' . $row['id'] . '" class="btn btn-primary edit-row" data-toggle="modal" >Manage</button>
                        ';
                    }

                    return '';

                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row['created_at'])->format('F j, Y g:i A');
                })
                ->addColumn('updated_at', function ($row) {
                    return Carbon::parse($row['updated_at'])->format('F j, Y g:i A');
                })
                ->addColumn('from', function ($row) {
                    return Carbon::parse($row['from'])->format('F j, Y g:i A');
                })
                // ->addColumn('to', function ($row) {
                //     return Carbon::parse($row['to'])->format('F j, Y g:i A');
                // })
                ->addColumn('purok', function ($row) {
                    return Carbon::parse($row['purok'])->format('F j, Y g:i A');
                })
                ->addColumn('brgy', function ($row) {
                    return Carbon::parse($row['brgy'])->format('F j, Y g:i A');
                })
                ->addColumn('police', function ($row) {
                    return Carbon::parse($row['police'])->format('F j, Y g:i A');
                })
                ->addColumn('nbi', function ($row) {
                    return Carbon::parse($row['nbi'])->format('F j, Y g:i A');
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.application');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $data = Payment::where('id', '=', $id)->first();
        if ($data) {
            if ($request->status == 'approved') {

                try {
                    $receiver = User::whereid($data->user_id)->first();
                    Mail::to($receiver->email)->send(new ApprovedEmail());

                    $currentTimestamp = Carbon::now();

                    $date_to = Carbon::now()->addMonth()->format('Y-m-d H:i:s');
                    $date_from = Carbon::now()->format('Y-m-d H:i:s');
                    Payment::whereId($id)->update([
                        'from' => $date_from,
                        'to' => $date_to,
                    ]);

                    User::whereid($data->user_id)->update([
                        'plan_until' => $date_to,
                        'plan' => $request->plan,
                    ]);

                    $data = Payment::whereId($id)->update([
                        'status' => $request->status,
                        'comments' => $request->comments,
                    ]);

                } catch (\Exception $e) {
                    \Log::error('Error sending email: ' . $e->getMessage());
                }

            }

            if ($request->status == 'rejected') {

                try {
                    $receiver = User::whereid($data->user_id)->first();
                    Mail::to($receiver->email)->send(new RejectedEmail());
                    $data = Payment::whereId($id)->update([
                        'status' => $request->status,
                        'comments' => $request->comments,
                    ]);
                } catch (\Exception $e) {
                    \Log::error('Error sending email: ' . $e->getMessage());
                }

            }

            return response()->json(['code' => 200, 'status' => 'success', 'data' => $data], 200);
        } else {
            return response()->json(['code' => 404, 'status' => 'success', 'message' => 'not found'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $data = Payment::where($where)->first();
        return Response::json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
