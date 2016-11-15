<?php
/**
 * Registrar aqui todas as dependencias
 */

use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Registra informações do Twig(Template Engine)
 */
$app->register(new Silex\Provider\TwigServiceProvider, [
    'twig.path' => __DIR__ . '/src/views'
]);

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => '/var/log/dbideias.log',
));

$app['request'] = Request::createFromGlobals();

/**
 * Registro de constantes para o twig
 */
$app['url_base'] = URL_BASE;
$app['url_public'] = URL_PUBLIC;
$app['url_auth'] = URL_AUTH;

// Helper para uso de Session
$app['my_session'] =  new BancoIdeias\helpers\Session('BANCODEIDEIAS');


// Registro para funcionar o Iluminate\Database

$capsule = new DB;

$capsule->addConnection([
    'driver' => DRIVER,
    'host' => HOST,
    'database' => DB,
    'username' => USER,
    'password' => PASS,
    'charset' => CHARSET,
    'collation' => 'utf8_unicode_ci',
    'prefix' => ''
]);
$capsule->setAsGlobal();

unset($capsule);

/**
 * Regitra Snappy PDF
 */
$app['snappy'] = function () {
    $exe = 'vendor/bin/wkhtmltopdf-amd64';
    return new Knp\Snappy\Pdf($exe);
};

/** 
 * Function Helper
 * Chamada do Twig nos Controllers
 */
function view() {
    global $app;
    return $app['twig'];
}

function request() {
    global $app;
    return $app['request'];
}

function session() {
    global $app;
    return $app['my_session'];
}