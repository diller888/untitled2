<?php

$db->where("link", $_GET['act']);
$moduls = $db->ObjectBuilder()->getOne("moduls");

if (isset($_GET['id']) && strlen($_GET['id']) > 0){
    if ($_GET['id'] == 'recovery'){
        $title = 'Напомнить пароль';
    } elseif ($_GET['id'] == 'reg'){
        $title = 'Регистрация';
    } else {
        header("Location: /err/404");
        exit;
    }
} else {
    $title = (!empty($moduls->title) ? $moduls->title : $moduls->name);
}
