<?php

namespace App\Http\Controllers;

use App\FeaturedPayment;
use App\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class FeatureListController extends Controller
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
                FeaturedPayment::where('id', '<>', 0)
            )
                ->addColumn('action', function ($row) {
                    if ($row['status'] == 'pending') {
                        return '
                        <button data-id="' . $row['id'] . '" class="btn btn-primary edit-row" data-toggle="modal" >Manage</button>
                        ';
                    }

                    return '';

                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.feature-list');
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
        $data = FeaturedPayment::where('id', '=', $id)->first();
        if ($data) {

            if ($request->status == 'approved') {
                $pid = $data->property_id;
                $property_data = Property::whereid($pid)->first();
                $ofed = $property_data->feature_end_date;
                $fed = new Carbon($ofed);
                $currentTimestamp = Carbon::now();

                if ($fed->gt($currentTimestamp)) {
                    $tfed = new Carbon($ofed);
                    $nfed = $tfed->addDays($request->days)->format('Y-m-d H:i:s');
                    FeaturedPayment::whereId($id)->update([
                        'from' => $fed,
                        'to' => $nfed,
                    ]);
                } else {
                    $tfed = Carbon::now();
                    $nfed = $tfed->addDays($request->days)->format('Y-m-d H:i:s');
                    $cfed = Carbon::now()->format('Y-m-d H:i:s');
                    FeaturedPayment::whereId($id)->update([
                        'from' => $cfed,
                        'to' => $nfed,
                    ]);
                }
                Property::whereid($pid)->update([
                    'feature_end_date' => $nfed,
                ]);

            }

            $data = FeaturedPayment::whereId($id)->update([
                'status' => $request->status,
                'comments' => $request->comments,
            ]);

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
        $data = FeaturedPayment::where($where)->first();
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
