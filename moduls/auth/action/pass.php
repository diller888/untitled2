<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';

if (!empty($_POST['login'])) {
    if (!empty($_POST['password'])) {
        if (strlen($_POST['password']) > 5) {
            $login = strip_tags($_POST['login']);
            $password = $_POST['password'];
            $db->where("login", $login);
            $db->where("password", $password);
            $ank = $db->ObjectBuilder()->getOne("users");
            if ($ank->password === $password && $ank->login === $login) {
                echo json_encode(array('result' => 'success'));
            } else {
                if ($ank->password === $password && $ank->email === $login) {
                    echo json_encode(array('result' => 'success'));
                } else {
                    if ($ank->password === $password && $ank->phone === $login) {
                        echo json_encode(array('result' => 'success'));
                    } else {
                        echo json_encode(array('result' => 'error', 'msg' => 'Пароль не подходит'));
                    }
                }
            }
        } else {
            echo json_encode(array('result' => 'error', 'msg' => 'Пароль не менее 6 символов'));
        }
    } else {
        echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'));
    }

} else {
    echo json_encode(array('result' => 'error', 'msg' => 'Не верный логин'));
}
