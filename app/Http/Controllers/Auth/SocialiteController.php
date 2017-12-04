<?php
/**
 * Created by HanGang.
 * Date: 2017/12/4
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        dd($user);
        // $user->token;
    }
}