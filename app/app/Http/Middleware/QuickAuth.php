<?php

namespace App\Http\Middleware;

use Closure;
use Log;

use App\User;

use Illuminate\Support\Facades\Auth;

class QuickAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // Get the bearer token from the request header
        $bearer_token = $request->bearerToken();

        // If there is a token, find the user and log them in
        if (!is_null($bearer_token)) {
            $this->userLogin($this->findUser($bearer_token));
        } else {
            return response()->json(['error' => 'Token not found']);
        }

        Log::info(Auth::user());

        return $next($request);
    }

    /**
     * Finds a user by their bearer token
     *
     * @param integer $bearer_token (remember this is just
     *                                  the user_id in our case)
     * @return User
     */
    private function findUser($bearer_token)
    {
        return User::where('id', $bearer_token)->first();
    }

    /**
     * Logs in the user
     *
     * @param User $user
     * @return void
     */
    private function userLogin($user)
    {
        if (!is_null($user)) {
            Auth::login($user);
        } else {
            return response()->json(['error' => 'User not found']);
        }
    }
}
