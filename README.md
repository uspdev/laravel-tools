# Laravel-tools
Ferramentas e configurações úteis para aplicações laravel no contexto do USPDev.

* Interface para mostrar informações da aplicação e das biblitecas USPdev instaladas
* Visualizador de logs
* Ferramenta de backup/restore do DB (mysql/mariadb)
* Alguns helpers
* Configuração de https quando atrás de proxy

## Instalação

O backup/restore está disponível a partir do Laravel 11.

    composer require uspdev/laravel-tools

## Configuração

### Proxy

* **forcarHttps**: se a aplicação está atrás de um ppoxy e se comunica com o proxy por HTTP mas o proxy se comunica com o usuário por HTTPS, vc deve forçar o HTTPS no laravel,

### Helpers

* **linkify($texto)** - procura no texto por urls (ex. `http://github.com`) e transforma em links (`<a href="http://github.com">http://github.com</a>`)
* **hasReplicado()** - verifica se a biblioteca replicado está instalada
* **hasUspTheme()** - verifica se a biblioteca laravel-usp-theme está instalada
* **appVersion()** - mostra a versão da aplicação
* **md2html()** - converte markdown em html (no blade precisa usar {!! !!})


### Exemplo de configuração

```
# LARAVEL TOOLS #########################################
# https://github.com/uspdev/laravel-tools

# Se sua aplicação está atrás de um proxy e se comunica com o proxy por http mas o proxy 
# se comunica com o usuário por https, vc deve forçar o https no laravel (default = false).
#LARAVEL_TOOLS_FORCAR_HTTPS=false

# Ativa mensagens de debug (default = app.debug)
#LARAVEL_TOOLS_DEBUG=

```

### Menu na aplicação

No config/laravel-usp-theme.php, coloque ou reposicione a chave laravel-tools para mostrar o menu. Ele será visível somente para admin.

```php
[
    'key' => 'laravel-tools',
],

```

## Changelog

#### 13/8/2025 

* release 1.5.0
* novo helper md2html()