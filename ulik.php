<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require H.'app/inc/func/session.php';

$sess = new Session();

//$sess->insert('name', 'diller');
//$sess->insert('test', 'test');


print_r($sess->name);