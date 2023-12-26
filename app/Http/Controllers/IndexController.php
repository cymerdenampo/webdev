<?php

namespace App\Http\Controllers;

use App\BookingPayment;
use App\Image;
use App\Property;
use Auth;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkUserInfo');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Property::with(['images'])
            ->where('status', 'active')
            ->where('sold_or_leased', 0)
            ->orderby('updated_at', 'desc')
            ->paginate(18);
        $featured = Property::with(['images', 'created_by'])
            ->where('status', 'active')
            ->where('sold_or_leased', 0)
            ->whereHas('created_by', function ($query) {
                $query->where('plan', 'premium');
            })
            ->orderby('updated_at', 'desc')
            ->get();

        $sold = Property::with(['images'])
            ->where('status', 'active')
            ->where('sold_or_leased', 1)
            ->orderby('updated_at', 'desc')
            ->paginate(6);

        return view('welcome', ['data' => $data, 'featured' => $featured, 'sold' => $sold]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Property::whereid($id)->with(['created_by'])->where('status', 'active')->first();
        if ($data) {
            $images = Image::where('property_id', $id)->get();
            $bp = null;
            $stay_until = null;
            $pending = 0;

            if (Auth::check()) {

                $user = auth()->user();
                $role = $user->roles->first();

                if ($role->name == 'tenant') {
                    $bp = BookingPayment::where('tenant_id', auth()->user()->id)->with(['sent_by'])->where('property_id', $data->id)->orderBy('id', 'desc')->get();
                    $pending = $bp->where('status', 'pending')->count();
                } else if ($role->name == 'owner') {
                    $bp = BookingPayment::with(['property_info', 'sent_by'])->where('property_id', $data->id)->orderBy('id', 'desc')
                        ->whereHas('property_info', function ($query) {
                            $query->where('created_by_user_id', auth()->user()->id);
                        })
                        ->get();
                } else {
                    $bp = BookingPayment::with(['sent_by'])->where('property_id', $data->id)->orderBy('id', 'desc')->get();
                }

                $stay_until = BookingPayment::whereNotNull('to')->where('to', '>', now())->where('status', 'approved')->where('property_id', $data->id)->where('tenant_id', auth()->user()->id)->orderBy('to', 'desc')->first();
            }

            return view('boardhouse', ['data' => $data, 'images' => $images, 'bookings' => $bp, 'pending' => $pending, 'stay_until' => $stay_until]);
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
