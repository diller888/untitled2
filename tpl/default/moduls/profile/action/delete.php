<?php

define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';

if ($user) {

    if (!empty($_POST['id'])) {
        $params = array(
            "id_user" => $user->id,
            "avatar" => 1
        );
        $avatar = $db->select("users__photo", $params);
        if ($avatar) {
            if ($avatar->id_user == $user->id) {

                $path = H . '/uploads/users/' . $user->id . '/photo/';
                @unlink($path . $avatar->screen);
                $db->delete('users__photo', $avatar->id);
                echo json_encode(array('result' => 'success'));

            } else echo json_encode(array('error' => 'Файл вам не принадлежит'));

        } else echo json_encode(array('error' => 'Файл не существует'));

    } else echo json_encode(array('error' => 'Файл не существует'));

} else echo json_encode(array('error' => 'Вы не авторизованы'));