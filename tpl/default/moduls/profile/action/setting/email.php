<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';

if ($user) {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $ank = $db->selectOne("users", 'id', $user->id);
            if ($ank){
                if ($email != $ank->email){
                    $q = $db->dbquery('users', "`email` = '".$email."' AND `id` != '".$ank->id."'");
                    $res = mysqli_num_rows($q);
                    if ($res > 0){
                        echo json_encode(array('result' => 'error', 'msg' => 'Email уже зарегистрирован'));
                    } else echo json_encode(array('result' => 'success', 'msg' => 'Email будет изменен'));
                } else echo json_encode(array('result' => 'success', 'msg' => ''));
            } else echo json_encode(array('result' => 'error', 'msg' => 'Не могу найти пользователя'));
        } else  echo json_encode(array('result' => 'error', 'msg' => 'Не валидный email'));
    } else echo json_encode(array('result' => 'error', 'msg' => 'Укажите поле email'));
} else echo json_encode(array('result' => 'error', 'msg' => 'Вы не авторизованы'));