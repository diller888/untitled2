<?php

define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';

if ($user) {
    if (!empty($_POST['name'])) {
        if (strlen($_POST['name']) < 4) {
            $err = 'ФИО не указано';
        } elseif (preg_match("/([^s]+)s+([^s.])[^s.]*(?:s|.)([^s.])[^s.]*/", strtolower($_POST['name']))){
            $err = 'Ошибка ввода ФИО';
        } else {
            $countName = explode(' ', $_POST['name']);
            if ($countName[1]){
                if (strlen($countName[1])<6)$err = 'Укажите фамилию';
            } else $err = 'ФИО должно состоять не меньше, чем из двух слов ';
        }
        if (!isset($err)) {
            $name = $_POST['name'];
            $ank = $db->selectOne("users", 'id', $user->id);
            if ($ank){
                if ($name != $ank->name){
                    $msg = 'Имя будет изменено';
                } else $msg = '';
                echo json_encode(array('result' => 'success', 'msg' => $msg));
            } else echo json_encode(array('result' => 'error', 'msg' => 'Не могу найти пользователя'));
        } else echo json_encode(array('result' => 'error', 'msg' => $err));

    } else echo json_encode(array('result' => 'error', 'msg' => 'Поле имя не заполнено'));
} else echo json_encode(array('result' => 'error', 'msg' => 'Вы не авторизованы'));