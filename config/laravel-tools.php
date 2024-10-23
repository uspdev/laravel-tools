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

    // as variáveis do $_SERVER não ficam disponíveis em desenvolvimento, pois o php artisan serve não lê o .htaccess, somente o apache o faz
    // então as definimos aqui, para não dar erro no Laravel tools Dashboard em desenvolvimento
    'gatewayInterface' => isset($_SERVER['GATEWAY_INTERFACE']) ? $_SERVER['GATEWAY_INTERFACE'] : '',
    'serverSoftware' => isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '',
];
