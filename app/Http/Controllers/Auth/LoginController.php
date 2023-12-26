<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        // Check if the user with this Facebook ID already exists in your database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Log in the existing user
            auth()->login($existingUser);
        } else {
            // Create a new user using Facebook data (you may need to adjust this based on your user model)
            $newUser = new User;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->facebook_id = $user->id;
            $newUser->save();

            $role = Role::findByName('user');
            $newUser->assignRole($role);

            // $newUser->sendEmailVerificationNotification();

            // Log in the newly created user
            auth()->login($newUser);
        }

        return redirect('/home');
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        // Check if the user with this Facebook ID already exists in your database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Log in the existing user
            auth()->login($existingUser);
        } else {
            // Create a new user using Facebook data (you may need to adjust this based on your user model)
            $newUser = new User;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->save();

            $role = Role::findByName('user');
            $newUser->assignRole($role);

            // Log in the newly created user
            auth()->login($newUser);
        }

        return redirect('/home');
    }
}
