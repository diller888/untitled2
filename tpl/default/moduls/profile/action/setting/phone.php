<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';

if ($user) {
    if (!empty($_POST['phone'])) {
        $phone = preg_replace("/[^,.0-9]/", '', $_POST['phone']);
        if (strlen($phone) < 11)$err = 'Укажите номер телефона';
        if (!isset($err)){
            $ank = $db->selectOne("users", 'id', $user->id);
            if ($ank){
                if ($phone != $ank->phone){
                    $q = $db->dbquery('users', "`phone` = '".$phone."' AND `id` != '".$ank->id."'");
                    $res = mysqli_num_rows($q);
                    if ($res > 0){
                        echo json_encode(array('result' => 'error', 'msg' => 'Номер телефона уже зарегистрирован'));
                    } else echo json_encode(array('result' => 'success', 'msg' => 'Телефон будет изменен'));
                } else echo json_encode(array('result' => 'success', 'msg' => ''));
            } else echo json_encode(array('result' => 'error', 'msg' => 'Не могу найти пользователя'));
        } else echo json_encode(array('result' => 'error', 'msg' => $err));
    } else echo json_encode(array('result' => 'error', 'msg' => 'Укажите поле телефон'));
} else echo json_encode(array('result' => 'error', 'msg' => 'Вы не авторизованы'));