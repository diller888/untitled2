<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require_once H . 'app/inc/core.php';

if (!empty($_POST['phone'])) {
    $phone = preg_replace("/[^,.0-9]/", '', $_POST['phone']);
    if (strlen($phone) > 10) {
        $db->where("phone", $phone);
        $ank = $db->ObjectBuilder()->getOne("users");
        if ($ank->phone === $phone){
            echo json_encode(array('result' => 'error', 'msg' => 'Номер телефона уже зарегистрирован'));
        } else {
            echo json_encode(array('result' => 'success'));
        }
    } else {
        echo json_encode(array('result' => 'error', 'msg' => 'Укажите номер телефона'));
    }
} else {
    echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'));
}

