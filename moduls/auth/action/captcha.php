<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require_once H . 'app/inc/core.php';

if (!empty($_POST['chislo'])) {
    if (strlen($_POST['chislo']) == 5) {
        $chislo = intval($_POST['chislo']);
        if ($chislo == $_SESSION['captcha']){
            echo json_encode(array('result' => 'success'));
        } else {
            echo json_encode(array('result' => 'error', 'msg' => 'Не верное число'));
        }
    } else
        echo json_encode(array('result' => 'error', 'msg' => 'Число меньше 5 символов'));

} else
    echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'));

