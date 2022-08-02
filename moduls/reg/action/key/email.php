<?php
if (!empty($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        if (strlen($_POST['email']) > 8) {
            $db->where("email", $_POST['email']);
            $ankEmail = $db->ObjectBuilder()->getOne("users");
            if ($ankEmail->email === $_POST['email']) {
                $err = 'email уже зарегистрирован';
            } else {
                $sess->email = $_POST['email'];
                array_push($dataUser, 'email', $_POST['email']);
            }
        } else $err = 'Заполните поле email';
    } else {
        $err = 'Не валидный email';
    }
} else $err = 'Не указан email';