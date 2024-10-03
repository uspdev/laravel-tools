<?php

namespace Uspdev\LaravelTools\Http\Controllers;

use Illuminate\Http\Request;
use Composer\InstalledVersions;
use Illuminate\Routing\Controller;
use Uspdev\LaravelTools\Services\Formatters;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DateTime;

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

    /**
     * Exibe um dashboard com funcionalidades de backup do banco de dados
     */
    public static function backup(Request $request)
    {
        $request->validate([
            'tab' => 'nullable|string',
            'file' => 'nullable|string',
        ]);
        $vars['activeTab'] = $request->tab ?: 'app';

        
        $files = Storage::allFiles('snapshots');
        $backupsList = [];

        foreach($files as $file){
            $name = Str::after($file, 'snapshots/');
            $time = Storage::lastModified('snapshots/'.$name);
            $size = Storage::size('snapshots/'.$name);

            $size = number_format($size / 1024, 2) . ' KB';
            $lastModified = (new DateTime())->setTimestamp($time)->format('Y-m-d H:i:s');

            $backupsList[] = [
                'name' => $name,
                'last_modified' => $lastModified,
                'size' => $size,
                'timestamp' => $time, 
            ];
        }

        usort($backupsList, function ($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        $vars['resultado'] = $backupsList;

        return view('laravel-tools::dashboard', $vars);
    }

    /**
     * Cria um backup do estado atual do banco de dados
     */
    public static function createBackup()
    {
        Artisan::call('snapshot:create');
        return redirect(route('laravel-tools.backup', ['tab' => 'backup']));
    }

    /**
     * Carrega o backup passado via request para o banco de dados
     */
    public static function loadBackup(Request $request)
    {
        $name = $request->input('name');

        if (!defined('STDIN')) { // Solução para o Error Undefined constant "STDIN" 
            define('STDIN', fopen('php://stdin', 'r')); // https://stackoverflow.com/questions/21184962/use-of-undefined-constant-stdin-assumed-stdin-in-c-wamp-www-study-sayhello
        }

        Artisan::call('snapshot:load ' . $name);
        return redirect(route('laravel-tools.backup', ['tab' => 'backup']));
    }

    /**
     * Faz o download do arquivo do backup passado via request para a máquina do usuário
     */
    public function downloadBackup(Request $request)
    {
        $name = $request->input('name');
        $nomeServidor = Str::after(config('app.url'), 'https://');
        $nomeServidor = Str::before($nomeServidor, '/');
        $nomeArquivo = Str::lower(config('app.name')) . '_at_' . $nomeServidor . '_' . $name ;
        return response()->download(storage_path("app/snapshots/" . $name ), $nomeArquivo);
    }

    /**
     * Faz o upload de um arquivo de backup escolhido pelo usuário
     */
    public function uploadBackup(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file',
        ]);

        $arquivo = $request->file('backup_file');
        $caminho = base_path('database/snapshots/');

        $arquivo->move($caminho, str_replace(' ', '_', $arquivo->getClientOriginalName()));
        return redirect(route('laravel-tools.backup', ['tab' => 'backup']));
    }

    /**
     * Apaga o backup que foi passado via request 
     */
    public static function deleteBackup(Request $request)
    {
        $name = $request->input('name');
        Artisan::call('snapshot:delete ' . $name);

        return redirect(route('laravel-tools.backup', ['tab' => 'backup']));
    }
}
