<?php

namespace Uspdev\LaravelTools\Http\Controllers;

use Composer\InstalledVersions;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Exibe um dashboard com informações do sistema
     */
    public function dashboard()
    {
        $this->authorize('admin');
        $packageName = InstalledVersions::getRootPackage()['name'];
        return view('laravel-tools::dashboard', compact('packageName'));
    }
}
