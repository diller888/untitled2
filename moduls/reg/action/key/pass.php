<?php
if (!empty($_POST['password'])) {
    if (strlen($_POST['password']) < 6) $err = 'Пароль меньше 6 символов';
    if (strlen($_POST['password']) < 6) $err = 'Пароль не может быть короче 6 символов';
    if (strlen($_POST['password']) > 32) $err = 'Длина пароля превышает 32 символа';
    $password = $_POST['password'];
    $pass = md5($_POST['password']);
    array_push($dataUser, 'pass', $pass);
    array_push($dataUser, 'password', $password);
    $sess->pass = $_POST['pass'];
    $sess->password = $_POST['password'];
} else $err = 'Не указан пароль';