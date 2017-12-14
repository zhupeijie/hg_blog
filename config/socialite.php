<?php
/**
 * Created by HanGang.
 * Date: 2017/12/4
 */

return [
    'github' => [
        'client_id'     => env('OAUTH_GITHUB_CLIENT_ID', ''),
        'client_secret' => env('OAUTH_GITHUB_CLIENT_SECRET', ''),
        'redirect'      => env('OAUTH_GITHUB_REDIRECT_URI', ''),
    ],
];