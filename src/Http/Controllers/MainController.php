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
use Illuminate\Support\Facades\File;

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
        // dd(config('filesystems.disks.snapshots.root'));
        $request->validate([
            'tab' => 'nullable|string',
            'file' => 'nullable|string',
        ]);
        $vars['activeTab'] = $request->tab ?: 'app';

        
        // $files = Storage::allFiles('app/laravel-db-snapshots');
        $files = File::files(config('filesystems.disks.snapshots.root'));
        // dd($files);
        $backupsList = [];

        foreach($files as $file){
            $name = Str::after($file, 'snapshots/');
            $time = $file->getMTime();
            $size = $file->getSize();

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
        $name = Str::before($name, '.sql.gz');

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

        $appServer = Str::lower(config('app.name')) . '_at_' . $nomeServidor . '_';

        if (!Str::startsWith($name, $appServer)) {
            $nomeArquivo = $appServer . $name;
        } else {
            $nomeArquivo = $name;
        }

        return response()->download(config('filesystems.disks.snapshots.root') . $name , $nomeArquivo);
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
        $caminho = config('filesystems.disks.snapshots.root');
        $nomeArquivo = str_replace(' ', '_', $arquivo->getClientOriginalName());
        $nomeArquivo = str_replace('(', '_', $nomeArquivo);
        $nomeArquivo = str_replace(')', '_', $nomeArquivo);

        $arquivo->move($caminho, $nomeArquivo);
        return redirect(route('laravel-tools.backup', ['tab' => 'backup']));
    }

    /**
     * Apaga o backup que foi passado via request 
     */
    public static function deleteBackup(Request $request)
    {
        $name = $request->input('name');
        $name = Str::before($name, '.sql.gz');

        Artisan::call('snapshot:delete ' . $name);

        return redirect(route('laravel-tools.backup', ['tab' => 'backup']));
    }
}
