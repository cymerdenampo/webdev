<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Image;
use App\User;
use App\Property;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        Comment::create([
            'user_id' => auth()->user()->id,
            'property_id' => $request->property_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (request()->ajax()) {

            return datatables()->of
            (
                Visit::with('visitor')->where('property_id', $id)
            )
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row['created_at'])->format('F j, Y g:i A');
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $comments = Comment::with('user')->where('property_id', $id)->orderby('created_at', 'desc')->get();
        $visitors = Visit::with('visitor')->where('property_id', $id)->orderby('created_at', 'desc')->get();

        $data = Property::whereid($id)->with(['created_by'])->where('status', 'active')->first();
        if ($data) {
            $images = Image::where('property_id', $id)->get();

            if (Auth::check()) {
                $role = auth()->user()->id == $data->created_by->id ? 'seller' : 'buyer';

                if (auth()->user()->roles->first()->name !== 'admin') {
                    if ($role == 'buyer') {
                        Visit::create([
                            'property_id' => $id,
                            'visitor_id' => auth()->user()->id,
                            'role' => $role,
                        ]);
                    }
                }

                return view('lot', [
                    'data' => $data,
                    'images' => $images,
                    'role' => $role,
                    'comments' => $comments,
                    'visitors' => $visitors,
                ]);
            }

            return view('lot', [
                'data' => $data,
                'images' => $images,
                'role' => null,
                'comments' => $comments,
                'visitors' => $visitors,
            ]);

        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
