<?php

use Composer\InstalledVersions;
/**
 * Recupera dados da versão do pacote (package) instalado via composer
 *
 * @param String $package nome do pacote no formato 'vendor/nome-do-pacote'
 * @return String|Bool
 * @author Masaki K Neto, em 11/04/2022
 */
if (!function_exists('appVersion')) {
    function appVersion($package = null)
    {
        if ($package && InstalledVersions::isInstalled($package)) {
            $ret = InstalledVersions::getPrettyVersion($package);
            $ret .= ' (' . substr(InstalledVersions::getReference($package), 0, 7) . ')';
            return $ret;
        }

        if ($package == null) {
            $self = InstalledVersions::getRootPackage();
            return $self['pretty_version'] . ' (' . substr($self['reference'], 0, 7) . ')';
        }

        return false;
    }
}
