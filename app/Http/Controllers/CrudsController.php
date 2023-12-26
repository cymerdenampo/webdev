<?php

namespace App\Http\Controllers;

use \App\Crud;
use Illuminate\Http\Request;

class CrudsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Crud::latest()->paginate(10);
        return view('index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $form_data = [
            'first_name' => $request->first_name,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $form_data['image'] = $new_name;
        }

        Crud::create($form_data);
        return redirect('crud')->with('success', 'Contact Added Successfully.');
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

        $data = Crud::findOrFail($id);
        return view('view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Crud::findOrFail($id);
        return view('edit', compact('data'));
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
        $request->validate([
            'first_name' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $form_data = [
            'first_name' => $request->first_name,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $form_data['image'] = $image_name;
        }

        Crud::whereId($id)->update($form_data);
        return redirect('crud')->with('success', 'Contact is Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Crud::findOrFail($id);
        $data->delete();
        return redirect('crud')->with('success', 'Contact is Successfully Deleted');
    }
}
