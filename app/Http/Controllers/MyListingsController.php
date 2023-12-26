<?php

namespace App\Http\Controllers;

use App\FeaturedPayment;
use App\Image;
use App\Property;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Response;

class MyListingsController extends Controller
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
                Property::where('created_by_user_id', auth()->user()->id)
            )
                ->addColumn('action', function ($row) {

                    if ($row['type'] == 'lease') {
                        $sold_or_leased_new = $row['sold_or_leased'] == 1 ? 0 : 1;
                        $sold_or_leased_text = $row['sold_or_leased'] == 1 ? 'for lease' : 'leased';
                        $sold_or_leased_color = $row['sold_or_leased'] == 1 ? 'default' : 'success';
                        $sold_or_leased_icon = $row['sold_or_leased'] == 1 ? 'check' : 'check';
                    } else {
                        $sold_or_leased_new = $row['sold_or_leased'] == 1 ? 0 : 1;
                        $sold_or_leased_text = $row['sold_or_leased'] == 1 ? 'for sale' : 'sold';
                        $sold_or_leased_color = $row['sold_or_leased'] == 1 ? 'default' : 'success';
                        $sold_or_leased_icon = $row['sold_or_leased'] == 1 ? 'check' : 'check';
                    }

                    return '
                    <button data-id="' . $row['id'] . '" class="btn btn-primary edit-row" data-toggle="modal" >Edit Details</button>
                    <button data-id="' . $row['id'] . '"  data-statusnew="' . $sold_or_leased_new . '" data-statustext="' . $sold_or_leased_text . '" class="btn btn-' . $sold_or_leased_color . '  update-sold-or-leased" data-toggle="modal"><i class="fa fa-' . $sold_or_leased_icon . '"></i> Mark ' . $sold_or_leased_text . '</button>
                    <a href="/lot/' . $row['id'] . '" target="_blank" class="btn btn-link"><i class="fa fa-eye"></i> View </a>
                    ';

                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('user.listings');
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
        $data = Property::where('id', '=', $id)->first();

        if ($request->action && $request->action == 'sold_or_leased') {
            $except = ['action'];
            $request = request();
            $clean = $request->except($except);

            $data = Property::whereId($id)->update($clean);
            return response()->json(['code' => 200, 'status' => 'success', 'data' => $data], 200);
        }

        if ($request->action && $request->action == 'feature') {

            $this->validate($request, [
                'gcash_reference_code' => [
                    'required',
                    'unique:featured_payments',
                ],
            ]);

            FeaturedPayment::create([
                'property_id' => $id,
                'gcash_reference_code' => $request->gcash_reference_code,
                'sender_gcash_number' => $request->sender_gcash_number,
                'owner_id' => auth()->user()->id,
            ]);
            return response()->json(['code' => 200, 'status' => 'success'], 200);
        }

        if ($data) {
            $this->validate($request, [
                'title' => ['required', 'min:3', 'max:50', Rule::unique('properties', 'title')->ignore($id, 'id')],
                'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
                'description' => "required",
                'type' => "required|string",
                'location' => "required|string",
                'area' => "required|regex:/^\d+(\.\d{1,2})?$/",
                'country' => "required|string",
                'province' => "required|string",
                'city' => "required|string",
            ]);

            $data2 = Property::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'location' => $request->location,
                'type' => $request->type,
                'area' => $request->area,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'country' => $request->country,
                'province' => $request->province,
                'city' => $request->city,
                'created_by_user_id' => auth()->user()->id,
                'video_link' => $request->video_link,
                'barangay' => $request->barangay,
            ]);

            if ($request->has('lease_freq')) {
                Property::whereId($id)->update([
                    'lease_freq' => $request->lease_freq,
                ]);
            }

            if ($request->removedImageIds) {
                foreach ($request->removedImageIds as $the_id) {
                    Image::whereId($the_id)->delete();
                }
            }

            if ($request->has('images')) {
                $images = $request->file('images');
                if ($images) {
                    foreach ($images as $index => $image) {
                        $path = $image->store('images', 'public');
                        Image::create([
                            'image_path' => $path,
                            'property_id' => $id,
                        ]);
                    }
                }
            }

            return response()->json(['code' => 200, 'status' => 'success', 'data' => $data2], 200);
        } else {

            $this->validate($request, [
                'title' => ['required', 'min:3', 'max:50', Rule::unique('properties', 'title')],
                'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
                'description' => "required",
                'area' => "required|regex:/^\d+(\.\d{1,2})?$/",
                'location' => "required|string",
                'type' => "required|string",
                'country' => "required|string",
                'province' => "required|string",
                'city' => "required|string",
            ]);

            $data2 = Property::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'location' => $request->location,
                'area' => $request->area,
                'type' => $request->type,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'country' => $request->country,
                'province' => $request->province,
                'city' => $request->city,
                'created_by_user_id' => auth()->user()->id,
                'status' => 'active',
                'video_link' => $request->video_link,
                'barangay' => $request->barangay,
            ]);

            if ($request->has('lease_freq')) {
                Property::whereId($data2->id)->update([
                    'lease_freq' => $request->lease_freq,
                ]);
            }

            if ($request->has('images')) {
                $images = $request->file('images');

                foreach ($images as $index => $image) {
                    $path = $image->store('images', 'public');
                    Image::create([
                        'image_path' => $path,
                        'property_id' => $data2->id,
                    ]);
                }
            }

            return response()->json(['code' => 200, 'status' => 'success', 'data' => $data2], 200);
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
        $data = Property::where($where)->first();
        $data2 = Image::where('property_id', $data->id)->get();
        $data3 = FeaturedPayment::where('property_id', $data->id)->orderBy('id', 'desc')->get();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data' => $data,
            'images' => $data2,
            'feature_payments' => $data3,
        ], 200);
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
