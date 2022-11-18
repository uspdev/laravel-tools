<?php

use Uspdev\Replicado\Replicado;

/**
 * Verifica se a biblioteca replicado está instalada
 *
 * Todo: verifica a configuração
 *
 * @return boolean
 * @author Masaki K Neto, em 29/11/2021
 */
if (!function_exists('hasReplicado')) {

    function hasReplicado(bool $humanReadable = false)
    {
        // versão 2 possui a classe replicado
        if (\class_exists('Uspdev\\Replicado\\Replicado')) {
            // if (DB::test()) {
                return 'v2';
            // }
        }
        if (\class_exists('Uspdev\\Replicado\\DB')) {
            return $humanReadable ? 'true' : true;
        }
        return $humanReadable ? 'false' : false;
    }
}
