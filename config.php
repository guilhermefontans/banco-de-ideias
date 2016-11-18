<?php
/**
 * Variaveis e contantes de configuração aqui
 */
// Define se a aplicação esta em modo debug(true|false)
define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT', realpath(__DIR__ . DS . '..'));
// URL Base do projeto
define('URL_BASE', getenv("URL") .'/');

// URL Public do projeto
define('URL_PUBLIC', '/public');

// URL que necessita estar autenticado
define('URL_AUTH', getenv("URL").'/auth/');

// URL para exibir tela de acesso restrito
define('URL_RESTRICT', getenv("URL"). '/auth/restrict/');
/**
 * Constantes de conexão com o Database
 */
define('HOST', 'localhost');
define('DRIVER', 'mysql');
define('DB', 'dbideias');
define('USER', 'root');
define('PASS', 'root');
define('PORT', 3306);
define('CHARSET', 'UTF8');
define('DSN', DRIVER . ':host='. HOST.';port='.PORT.';dbname='.DB.';charset='.CHARSET);