<?php

namespace Uspdev\LaravelTools\Http\Controllers;

use Rap2hpoutre\LaravelLogViewer\LogViewerController as BaseController;

class LogViewerController extends BaseController
{

    public function __construct()
    {
        $this->view_log = 'laravel-tools::log';
        parent::__construct();
    }
}
