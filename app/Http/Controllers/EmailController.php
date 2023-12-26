<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function email(Request $request)
    {

        $user = User::whereid($request->sellerId)->first();
        
        Mail::to($user->email)->send(new MyEmail());
    }
}
