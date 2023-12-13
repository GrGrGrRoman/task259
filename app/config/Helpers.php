<?php

namespace App\config;

class Helpers
{
    public $str;

    // отладка
    static public function dd($str)
    {
        echo '<pre>';
        var_dump($str);
        echo '</pre>';
        exit;
    }

    static public function d($str)
    {
        echo '<pre>';
        var_dump($str);
        echo '</pre>';
    }

    // session
    public static function setSession($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function existsSession($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function deleteSession($name)
    {
        if(self::existsSession($name)) {
            unset($_SESSION[$name]);
            session_destroy();
        }
    }

    public static function getSession($name)
    {
        return $_SESSION[$name];
    }

    // cookie
    public static function existsCookie($name)
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    public static function getCookie($name) {
        return $_COOKIE[$name];
    }

    public static function putCookie($name, $value, $expiry)
    {
        setcookie($name, $value, time() + $expiry, '/');
    }

    public static function deleteCookie($name)
    {
        self::putCookie($name, '', time() - 1);
    }

}