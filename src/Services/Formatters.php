<?php

namespace Uspdev\LaravelTools\Services;

class Formatters
{
    public static function AppVersion($app)
    {
        if ($appVersion = appVersion($app)) {
            return '<a href="https://github.com/' . $app . '" target="github">' . $appVersion . '</a>';
        }
        return 'não instalado';
    }

    public static function config($key, $val)
    {
        $masks = ['key', 'password', 'client_secret'];
        if (in_array($key, $masks)) {
            return str_repeat('*', strlen($val)) . substr($val, -3);
        }
        if (is_bool($val)) {
            return $val ? 'true' : 'false';
        }
        if (is_array($val)) {
            return json_encode($val, JSON_UNESCAPED_UNICODE);
        }
        return $val;
    }
}
