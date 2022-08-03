<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (strlen($email) > 8) {
            $ank = $db->selectOne("users", "email", $email);
            if ($ank->email === $email) {
                echo json_encode(array('result' => 'error', 'msg' => 'email уже зарегистрирован'));
            } else {
                echo json_encode(array('result' => 'success'));
            }
        } else
            echo json_encode(array('result' => 'error', 'msg' => 'Заполните поле email'));

    } else
        echo json_encode(array('result' => 'error', 'msg' => 'Не валидный email'));

} else echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'));
