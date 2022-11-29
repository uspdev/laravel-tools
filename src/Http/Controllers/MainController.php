<?php

namespace Uspdev\LaravelTools\Http\Controllers;

use Composer\InstalledVersions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Uspdev\LaravelTools\Services\Formatters;

class MainController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Exibe um dashboard com informações do sistema
     */
    public function dashboard(Request $request)
    {
        $this->authorize('admin');
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
