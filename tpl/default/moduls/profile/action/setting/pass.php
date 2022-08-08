<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';

if ($user) {
    if (!empty($_POST['password'])) {
        $password = str_replace(' ', '', $_POST['password']);
        $pass = md5($password);
        if (strlen($password) > 32) {
            echo json_encode(array('result' => 'error', 'msg' => 'Пароль не более 32 символов'));
        } elseif (strlen($password) < 6) {
            echo json_encode(array('result' => 'error', 'msg' => 'Пароль не менее 6 символов'));
        } else {
            $ank = $db->selectOne("users", 'id', $user->id);
            if ($ank){
                if ($password != $ank->password){
                    echo json_encode(array('result' => 'success', 'msg' => 'Пароль будет изменен'));
                } else echo json_encode(array('result' => 'success', 'msg' => ''));
            } else echo json_encode(array('result' => 'error', 'msg' => 'Не могу найти пользователя'));
        }
    } else echo json_encode(array('result' => 'error', 'msg' => 'Укажите пароль'));
} else echo json_encode(array('result' => 'error', 'msg' => 'Вы не авторизованы'));