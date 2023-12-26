<?php

namespace App\Http\Middleware;

use App\Mail\ExpiredPlanEmail;
use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Mail;

class CheckUserInfo
{
    public function handle($request, Closure $next)
    {
        if (auth()) {

            // Check user information from the users table
            $user = auth()->user();

            // Check if the user's plan has expired
            if ($user && $user->plan_until && Carbon::now()->greaterThan($user->plan_until)) {

                try {
                    Mail::to($user->email)->send(new ExpiredPlanEmail());
                    // If the email is sent successfully, you can add any additional logic here
                    User::whereid($user->id)->update([
                        'plan_until' => null,
                        'plan' => 'free',
                    ]);
                    return redirect('/pricing');

                } catch (\Exception $e) {
                    // Handle the exception
                    // You can log the error, send a notification, or perform any other necessary actions
                    // For example, logging the error to Laravel's default log file:
                    \Log::error('Error sending email: ' . $e->getMessage());
                }

            }
        }

        return $next($request);

    }
}
