<?php

// https://github.com/uspdev/laravel-tools

return [
    # Se sua aplicação está atrás de um proxy e se comunica com o proxy por http
    # mas o proxy se comunica com o usuário por https, vc deve forçar o https no laravel
    'forcarHttps' => env('LARAVEL_TOOLS_FORCAR_HTTPS', false),

    # Ativa mensagens de debug
    'debug' => env('LARAVEL_TOOLS_DEBUG', config('app.debug')),

    # prefix pra as rotas. Se vazio desativa rotas
    'prefix' => 'laravel-tools',

    // template a ser estendido. Deve possuir a section "content"
    'template' => 'laravel-usp-theme::master',
];
