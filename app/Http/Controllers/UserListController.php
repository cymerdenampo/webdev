<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Response;

class UserListController extends Controller
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
                User::where('id', '<>', 0)
            )
                ->addColumn('action', function ($row) {

                    $user = $row;
                    $role = $user->roles->first();
                    if ($role && $role->name === 'admin') {
                        //admin
                        return '';
                    }

                    //not admin

                    if ($row['valid_id']) {
                        return '
                        <button data-id="' . $row['id'] . '" class="btn btn-primary edit-row" data-toggle="modal" >Edit</button>
                        <a target="_blank" href="/storage/' . $row['valid_id'] . '" class="btn btn-link" >View Id</button>
                        ';
                    }

                    return '
                    <button data-id="' . $row['id'] . '" class="btn btn-primary edit-row" data-toggle="modal" >Edit</button>
                    ';

                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.user-list');
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
        $data = User::where('id', '=', $id)->first();
        if ($data) {
            $this->validate($request, [
                'name' => 'required|min:3|max:50',
                'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($id, 'id')],
                'phone' => 'required|numeric',
            ]);

            $user = User::whereId($id)->update($request->all());
            return response()->json(['code' => 200, 'status' => 'success', 'data' => $user], 200);
        } else {
            return response()->json(['code' => 404, 'status' => 'success', 'message' => 'user not found'], 404);
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
        $user = User::where($where)->first();
        return Response::json($user);
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
