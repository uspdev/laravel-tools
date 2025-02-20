# admin-tools
Ferramentas e configurações úteis para aplicações laravel no contexto do USPDev.

## Instalação

    composer require uspdev/laravel-tools

## O que essa biblioteca fornece?

* forcarHttps

### Helpers

* **linkify($texto)** - procura no texto por urls (ex. `http://github.com`) e transforma em links (`<a href="http://github.com">http://github.com</a>`)
* **hasReplicado()** - verifica se a biblioteca replicado está instalada
* **hasUspTheme()** - verifica se a biblioteca laravel-usp-theme está instalada
* **appVersion()** - mostra a versão da aplicação

## Configuração

Exemplo de configuração e uso.

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

```
[
    'key' => 'laravel-tools',
],

```
