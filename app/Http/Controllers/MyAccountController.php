<?php

namespace App\Http\Controllers;

use App\SellerFile;
use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class MyAccountController extends Controller
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
                Payment::where('id', '<>', 0)
                    ->where('user_id', auth()->user()->id)
            )
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->addColumn('plan', function ($row) {
                    if ($row['plan'] == 'standard') {
                        return 'Standard Seller';
                    }
                    if ($row['plan'] == 'premium') {
                        return 'Premium Seller';
                    }
                })
                ->addColumn('created_at', function ($row) {
                    $carbonDate = Carbon::parse($row['created_at']);
                    $formattedDate = $carbonDate->format('F j, Y g:i A');
                    return $formattedDate;
                })
                ->addColumn('updated_at', function ($row) {
                    $carbonDate = Carbon::parse($row['updated_at']);
                    $formattedDate = $carbonDate->format('F j, Y g:i A');
                    return $formattedDate;
                })
                ->addColumn('from', function ($row) {
                    $carbonDate = Carbon::parse($row['from']);
                    $formattedDate = $carbonDate->format('F j, Y g:i A');
                    return $formattedDate;
                })
                ->addColumn('to', function ($row) {
                    $carbonDate = Carbon::parse($row['to']);
                    $formattedDate = $carbonDate->format('F j, Y g:i A');
                    return $formattedDate;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $sellerfile = SellerFile::where('user_id', auth()->user()->id)->first();

        return view('my-account', ['sellerfile' => $sellerfile]);

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

        if ($request->action == 'profile_pic_update') {
            $image = $request->file('image');
            if ($image) {
                $path = $image->store('profile-images', 'public');
                User::whereid(auth()->user()->id)->update([
                    'profile_pic' => $path,
                ]);
            }
        }

        if ($request->action == 'purok') {
            $image = $request->file('image');
            if ($image) {
                $path = $image->store('seller-files', 'public');
                $sellerfile = SellerFile::where('user_id', auth()->user()->id)->first();
                if ($sellerfile) {
                    SellerFile::where('user_id', auth()->user()->id)->update([
                        'purok' => $path,
                    ]);
                } else {
                    SellerFile::create([
                        'purok' => $path,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }
        }

        if ($request->action == 'brgy') {
            $image = $request->file('image');
            if ($image) {
                $path = $image->store('seller-files', 'public');
                $sellerfile = SellerFile::where('user_id', auth()->user()->id)->first();
                if ($sellerfile) {
                    SellerFile::where('user_id', auth()->user()->id)->update([
                        'brgy' => $path,
                    ]);
                } else {
                    SellerFile::create([
                        'brgy' => $path,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }
        }

        if ($request->action == 'police') {
            $image = $request->file('image');
            if ($image) {
                $path = $image->store('seller-files', 'public');
                $sellerfile = SellerFile::where('user_id', auth()->user()->id)->first();
                if ($sellerfile) {
                    SellerFile::where('user_id', auth()->user()->id)->update([
                        'police' => $path,
                    ]);
                } else {
                    SellerFile::create([
                        'police' => $path,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }
        }

        if ($request->action == 'nbi') {
            $image = $request->file('image');
            if ($image) {
                $path = $image->store('seller-files', 'public');
                $sellerfile = SellerFile::where('user_id', auth()->user()->id)->first();
                if ($sellerfile) {
                    SellerFile::where('user_id', auth()->user()->id)->update([
                        'nbi' => $path,
                    ]);
                } else {
                    SellerFile::create([
                        'nbi' => $path,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }
        }

        if ($request->action == 'cp') {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user = Auth::user();

            if (Hash::check($request->current_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);

                return response()->json(['code' => 200, 'status' => 'success'], 200);
            } else {
                throw ValidationException::withMessages(['current_password' => 'Current password is incorrect']);
            }
        }

        if ($request->action == 'info') {
            //save user info
            User::whereid(auth()->user()->id)->update([
                'phone' => $request->phone,
                'name' => $request->name,
                'address' => $request->address,
            ]);
            return response()->json(['code' => 200, 'status' => 'success'], 200);
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
