<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{
    public function provider()
    {
        return Socialite::driver('twitter-oauth-2')->redirect();
    }

    public function providerHandler()
    {
        $twitterUser = Socialite::driver('twitter-oauth-2')->user();
        $user = User::updateOrCreate([
            'twitter_id' => $twitterUser->id,
        ], [
            'name' => $twitterUser->name,
            'email' => $twitterUser->email,
            'twitter_token' => $twitterUser->token,
            'twitter_refresh_token' => $twitterUser->refreshToken,
            'password' => Hash::make($twitterUser->id)
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
