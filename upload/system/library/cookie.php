<?php
namespace Commentics;

class Cookie
{
    public function exists($name)
    {
        if (isset($_COOKIE[$name])) {
            return true;
        } else {
            return false;
        }
    }

    public function get($name)
    {
        return $_COOKIE[$name];
    }

    public function set($name, $value, $expire, $path = '/', $domain = null, $secure = null, $httponly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
    }

    public function delete($name)
    {
        setcookie($name, '', time() - 3600, '/', null, null, true);
    }
}
