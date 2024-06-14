<?php

namespace Uspdev\LaravelTools\Services;

use Illuminate\Support\Facades\DB;

class Formatters
{
    public static function AppVersion($app)
    {
        if ($appVersion = appVersion($app)) {
            return '<a href="https://github.com/' . $app . '" target="github">' . $appVersion . '</a>';
        }
        return 'não instalado';
    }

    public static function dbVersion()
    {
        if (config('database.default') == 'mysql' || config('database.default') == 'mariadb') {
            $results = DB::select('SELECT version() as version');
            return $results[0]->version;
        }
        if (config('database.default') == 'sqlserver') {
            $results = DB::select('SELECT @@version as version');
            return $results[0]->version;
        }
        // outro sgbd ???
        return null;
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
            if (count(array_filter(array_keys($val), 'is_string')) > 0) {
                // array associativo
                return json_encode($val, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            } else {
                $ret = '';
                foreach ($val as $k => $v) {
                    $ret .= is_array($v) ? json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : $v;
                    $ret .= ', ';
                }
                return substr($ret, 0, -2);
            }
        }
        return $val;
    }
}
