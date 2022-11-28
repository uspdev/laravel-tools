<?php

use Composer\InstalledVersions;
/**
 * Verifica se a biblioteca senhaunica-socialite está instalada
 *
 * @return boolean
 * @author Masaki K Neto, em 29/11/2021
 */
if (!function_exists('hasSenhaunica')) {

    function hasSenhaunica(bool $humanReadable = false)
    {
        $package = 'uspdev/senhaunica-socialite';
        if(InstalledVersions::isInstalled($package)) {
            return InstalledVersions::getPrettyVersion($package);
        }
        return $humanReadable ? 'false' : false;
    }
}
