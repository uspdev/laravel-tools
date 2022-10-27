<?php

$helpers = ['linkify', 'hasReplicado', 'hasUspTheme', 'appVersion'];

foreach ($helpers as $helper) {
    require_once __DIR__ . '/helpers/'.$helper.'.helper.php';
}
