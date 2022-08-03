<?php

$moduls = $db->selectOne("moduls", "link", $_GET['act']);

if (isset($_GET['id']) && strlen($_GET['id']) > 0){
    if ($_GET['id'] == 'recovery'){
        $title = 'Напомнить пароль';
    } else {
        header("Location: /err/404");
        exit;
    }
} else
    $title = (!empty($moduls->title) ? $moduls->title : $moduls->name);
