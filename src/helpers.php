<?php

$helpers = ['linkify', 'hasReplicado', 'hasUspTheme', 'hasSenhaunica', 'appVersion'];

foreach ($helpers as $helper) {
    require_once __DIR__ . '/helpers/' . $helper . '.helper.php';
}
