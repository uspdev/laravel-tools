<?php
/**
 * Verifica se a biblioteca larave-usp-theme está instalada
 *
 * @return boolean
 * @author Masaki K Neto, em 29/11/2021
 */
if (!function_exists('hasUspTheme')) {

    function hasUspTheme()
    {
        return \class_exists('Uspdev\\UspTheme\\UspTheme') ? true : false;
    }
}