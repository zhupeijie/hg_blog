<?php
/**
 * Created by HanGang.
 * Date: 2017/12/4
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserSocialite;
use App\Repositories\UserRepository;
use Overtrue\LaravelSocialite\Socialite;
use Auth;

class SocialiteController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $user;

    /**
     * SocialiteController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function github()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function githubCallback()
    {
        $userInfo = Socialite::driver('github')->user();

        if (!$user = $this->user->findUserBySource($userInfo)) {
            $user = $this->store($userInfo);
        }

        Auth::login($user);

        $time = time();
        $singleToken = md5(request()->getClientIp() . user()->id . $time);
        // 当前 time 存入 Redis
        \Redis::set('blog:single_user_login_' . user()->id, $time);

        return redirect()->route('root')->withCookie('SINGLE_USER_LOGIN', $singleToken);
    }

    /**
     * Create an user and save socialite data.
     *
     * @param $userInfo
     * @return mixed
     */
    private function store($userInfo)
    {
        $user = $this->user->create([
            'name'     => $userInfo['username'],
            'email'    => $userInfo['email'],
            'password' => bcrypt($userInfo['email']),
            'avatar'   => $userInfo['avatar'],
            'source'   => UserSocialite::SOURCE_GIT_HUB,
        ]);

        (new UserSocialite())->create([
            'user_id' => $user->id,
            'source'  => UserSocialite::SOURCE_GIT_HUB,
            'data'    => json_encode($userInfo, JSON_UNESCAPED_UNICODE),
        ]);

        return $user;
    }
}