<?php

if (!empty($_POST['password'])) {
    if (strlen($_POST['password']) > 32) {
        echo json_encode(array('result' => 'error', 'msg' => 'Пароль не более 32 символов'));
    } elseif (strlen($_POST['password']) > 5) {
        echo json_encode(array('result' => 'success'));
    } else
        echo json_encode(array('result' => 'error', 'msg' => 'Пароль не менее 6 символов'));

} else
    echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'));
