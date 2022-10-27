<?php
/**
 * Recupera dados da versão da aplicação a partir do git
 *
 * $params = ['completo' => false]
 *
 * @param Array $params
 * @return String|Null
 * @author Masaki K Neto, em 11/04/2022
 */
if (!function_exists('appVersion')) {
    function appVersion($params = ['completo' => false, 'gitPath' => null])
    {

        $gitBasePath = $params['gitPath'] ?? base_path() . '/.git'; // e.g in laravel: base_path().'/.git';

        if (!file_exists($gitBasePath. '/HEAD')) {
            // gerar log em arquivo aqui

            if (config('laravel-tools.debug')) {
                return 'não é repositório git ' . realpath($gitBasePath);
            } else {
                return null;
            }
        }

        $gitStr = file_get_contents($gitBasePath . '/HEAD');
        $gitBranchName = rtrim(preg_replace("/(.*?\/){2}/", '', $gitStr));
        $gitPathBranch = $gitBasePath . '/refs/heads/' . $gitBranchName;
        $gitHash = substr(file_get_contents($gitPathBranch),0,7);
        // $gitDate = date(DATE_ATOM, filemtime($gitPathBranch));
        $gitDate = date('d/m/Y', filemtime($gitPathBranch));

        $HEAD_hash = file_get_contents('../.git/refs/heads/master'); // or branch x

        $return = "version date: " . $gitDate . "<br>branch: " . $gitBranchName . "<br> commit: " . $gitHash;

        $files = glob($gitBasePath . '/tags/*');
        foreach (array_reverse($files) as $file) {
            $contents = trim(file_get_contents($file));

            if ($HEAD_hash === $contents) {
                $return .= "\n" . 'Current tag is ' . basename($file);
            }
        }

        return $return;

    }
}
