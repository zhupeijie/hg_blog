<?php

if (!function_exists('user')) {
    /**
     * 获得登录用户信息
     *
     * @param null $diver
     *
     * @return mixed
     */
    function user($diver = null)
    {
        if ($diver) {
            return app('auth')->guard($diver)->user();
        }

        return app('auth')->user();
    }
}

if (!function_exists('hashIdEncode')) {
    /**
     * hash 加密id
     *
     * @param $id
     * @param string $connections
     *
     * @return mixed
     */
    function hashIdEncode($id, $connections = 'main')
    {
        return Hashids::connection($connections)->encode($id);
    }
}

if (!function_exists('hashIdDecode')) {
    /**
     * hash 解密id
     *
     * @param $id
     * @param $connections
     *
     * @return mixed
     */
    function hashIdDecode($id, $connections = 'main')
    {
        return Hashids::connection($connections)->decode($id);
    }
}

if (!function_exists('route_class')) {
    /**
     * 路由相关
     *
     * @return mixed
     */
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}

if (!function_exists('make_excerpt')) {
    /**
     * 截取一段特定长度的字串
     *
     * @param $value
     * @param int $length
     * @return string
     */
    function make_excerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return str_limit($excerpt, $length);
    }
}