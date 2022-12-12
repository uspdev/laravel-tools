<?php

namespace Uspdev\LaravelTools\Http\Controllers;

use Illuminate\Http\Request;
use Composer\InstalledVersions;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Uspdev\LaravelTools\Services\Formatters;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainController extends Controller
{
    use ValidatesRequests;

    /**
     * Exibe um dashboard com informações do sistema
     */
    public function app(Request $request)
    {
        $request->validate([
            'tab' => 'nullable|string',
            'file' => 'nullable|string',
        ]);

        $vars['activeTab'] = $request->tab ?: 'app';

        switch ($vars['activeTab']) {
            case 'app':
                $vars['packageName'] = InstalledVersions::getRootPackage()['name'];
                $vars['formatter'] = Formatters::class;
                break;
            case 'bibliotecas':
                $vars['formatter'] = Formatters::class;
                break;
            case 'logs':
                break;
        }
        return view('laravel-tools::dashboard', $vars);
    }
    /**
     * Exibe um dashboard com informações das bibliotecas USPDev
     */
    public function bibliotecas(Request $request)
    {
        $request->validate([
            'tab' => 'nullable|string',
            'file' => 'nullable|string',
        ]);

        $vars['activeTab'] = $request->tab ?: 'app';

        switch ($vars['activeTab']) {
            case 'app':
                $vars['packageName'] = InstalledVersions::getRootPackage()['name'];
                $vars['formatter'] = Formatters::class;
                break;
            case 'bibliotecas':
                $vars['formatter'] = Formatters::class;
                break;
            case 'logs':
                break;
        }
        return view('laravel-tools::dashboard', $vars);
    }
}
