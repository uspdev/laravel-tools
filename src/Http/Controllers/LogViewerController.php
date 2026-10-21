<?php

namespace Uspdev\LaravelTools\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class LogViewerController extends Controller
{
    public function index(Request $request)
    {
        \UspTheme::activeUrl(route('laravel-tools.app'));

        $logPath = storage_path('logs');
        $files = File::exists($logPath) ? File::allFiles($logPath) : [];
        
        // ordena do mais recente para o mais antigo
        usort($files, function ($a, $b) {
            return $b->getMTime() <=> $a->getMTime();
        });

        // ações dos botões da interface (download, clean, delete)
        if ($request->has('dl')) {
            $file = $this->decrypt($request->input('dl'));
            if ($file && File::exists($logPath . DIRECTORY_SEPARATOR . $file))
                return response()->download($logPath . DIRECTORY_SEPARATOR . $file);
        } elseif ($request->has('clean')) {
            $file = $this->decrypt($request->input('clean'));
            if ($file && File::exists($logPath . DIRECTORY_SEPARATOR . $file))
                File::put($logPath . DIRECTORY_SEPARATOR . $file, '');
            return redirect(route('laravel-tools.logs'));
        } elseif ($request->has('del')) {
            $file = $this->decrypt($request->input('del'));
            if ($file && File::exists($logPath . DIRECTORY_SEPARATOR . $file))
                File::delete($logPath . DIRECTORY_SEPARATOR . $file);
            return redirect(route('laravel-tools.logs'));
        } elseif ($request->has('delall')) {
            foreach ($files as $file)
                File::delete($file->getPathname());
            return redirect(route('laravel-tools.logs'));
        }

        $fileNames = [];
        foreach ($files as $file)
            $fileNames[] = $file->getFilename();

        // o parâmetro 'l' também vem encriptado da view
        $current_file = $request->input('l') ? $this->decrypt($request->input('l')) : (count($fileNames) > 0 ? $fileNames[0] : null);
        
        $logs = [];
        if ($current_file) {
            $filePath = $logPath . DIRECTORY_SEPARATOR . $current_file;
            if (File::exists($filePath))
                if (File::size($filePath) > 50 * 1024 * 1024)
                    $logs = null;
                else
                    $logs = $this->parseLog(File::get($filePath));
        }

        return view('laravel-tools::log', [
            'logs' => $logs,
            'files' => $fileNames,
            'current_file' => $current_file,
            'folders' => [],           // Corrigindo o Undefined variable $folders
            'current_folder' => '',    // Corrigindo o Undefined variable $current_folder
            'standardFormat' => true,
        ]);
    }

    /**
     * Tenta descriptografar, retorna null se for arquivo não encriptado ou inválido
     */
    private function decrypt($value)
    {
        try {
            return Crypt::decrypt($value);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Simula o parser original
     */
    private function parseLog($content)
    {
        $pattern = '/^\[(?P<date>\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}(?:[\+-]\d{4})?)\](?:.*?)(?P<env>\w+)\.(?P<type>[A-Z]+): (?P<message>.*)/m';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $logs = [];
        foreach ($matches as $match) {
            $level = strtolower($match['type']);
            $logs[] = [
                'context' => $match['env'], 
                'level' => $level,
                'level_class' => $this->getLevelClass($level),
                'level_img' => $this->getLevelImg($level), 
                'date' => $match['date'],
                'text' => $match['message'],
                'in_file' => null,
                'stack' => '',
            ];
        }
        return array_reverse($logs);
    }

    private function getLevelClass($level)
    {
        $classes = [
            'debug' => 'info', 'info' => 'info', 'notice' => 'info',
            'warning' => 'warning', 'error' => 'danger', 'critical' => 'danger',
            'alert' => 'danger', 'emergency' => 'danger', 'processed' => 'info'
        ];
        return $classes[$level] ?? 'info';
    }

    private function getLevelImg($level)
    {
        $images = [
            'debug' => 'info-circle', 'info' => 'info-circle', 'notice' => 'info-circle',
            'warning' => 'exclamation-triangle', 'error' => 'exclamation-triangle', 'critical' => 'exclamation-triangle',
            'alert' => 'exclamation-triangle', 'emergency' => 'exclamation-triangle', 'processed' => 'info-circle'
        ];
        return $images[$level] ?? 'info-circle';
    }
}
