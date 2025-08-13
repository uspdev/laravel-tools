<?php

$helpers = ['linkify', 'hasReplicado', 'hasUspTheme', 'hasSenhaunica', 'appVersion', 'md2html'];

foreach ($helpers as $helper) {
    require_once __DIR__ . '/helpers/' . $helper . '.helper.php';
}
