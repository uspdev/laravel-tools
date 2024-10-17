<?php

namespace Uspdev\LaravelTools\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Rap2hpoutre\LaravelLogViewer\LogViewerController as BaseController;

class LogViewerController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->view_log = 'laravel-tools::log';
        parent::__construct();
    }

    public function index()
    {
        \UspTheme::activeUrl(route('laravel-tools.app'));
        return parent::index();
    }
}
