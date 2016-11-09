<?php

include_once('../../config.php');

$pdo = new PDO(DSN, USER, PASS);
$stmt = $pdo->prepare('select login from usuario');
$stmt->execute();
$registeredLogin = $stmt->fetchAll(PDO::FETCH_OBJ);
$requestedLogin  = strtoupper($_REQUEST['login']);
$return = 'true';

array_map(
    function ($obj) use ($requestedLogin, &$return) {
        if (strtoupper($obj->login) == $requestedLogin) {
            $return = 'false';
            return;
        }
    }, $registeredLogin
);
echo $return;
