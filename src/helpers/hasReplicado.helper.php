<?php

use Composer\InstalledVersions;
use Uspdev\Replicado\Replicado;

/**
 * Verifica se a biblioteca replicado está instalada e retorna sua versão
 *
 * @param Bool $humanReadable Se true, retorna a versão ou 'false'
 * @return boolean|string
 * @author Masaki K Neto, em 29/11/2021
 */
if (!function_exists('hasReplicado')) {

    function hasReplicado(bool $humanReadable = false)
    {
        $package = 'uspdev/replicado';
        if (InstalledVersions::isInstalled($package)) {
            $ret = InstalledVersions::getPrettyVersion($package);
            $ret .= ' (' . substr(InstalledVersions::getReference($package), 0, 7) . ')';
            return $humanReadable ? $ret : true;
        }
        return $humanReadable ? 'false' : false;
    }
}
