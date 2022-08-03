<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';

if (!empty($_POST['login'])) {
    if (strlen($_POST['login']) > 3) {
        $login = strip_tags($_POST['login']);
        $ank = $db->selectOne("users","login", $login);
        if ($ank->login === $login) {
            echo json_encode(array('result' => 'success'));
        } else {
            if ($ank->email === $login) {
                echo json_encode(array('result' => 'success'));
            } else {
                if ($ank->phone === $login) {
                    echo json_encode(array('result' => 'success'));
                } else {
                    echo json_encode(array('result' => 'error', 'msg' => 'Пользователь не найден'));
                }
            }
        }
    } else {
        echo json_encode(array('result' => 'error', 'msg' => 'Логин более 3 символов'));
    }

} else {
    echo json_encode(array('result' => 'error', 'msg' => 'Не могу распознать данные'));
}
