<?php

define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';

if ($user) {
    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
        if (strlen($name) < 4) {
            $err = 'ФИО не указано';
        } elseif (preg_match("/([^s]+)s+([^s.])[^s.]*(?:s|.)([^s.])[^s.]*/", strtolower($name))){
            $err = 'Ошибка ввода ФИО';
        } else {
            $countName = explode(' ', $name);
            if ($countName[1]){
                if (strlen($countName[1])<6)$err = 'Укажите фамилию';
            } else $err = 'ФИО должно состоять не меньше, чем из двух слов ';
        }

    } else $err = 'Укажите имя и фамилию';

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
                        $err = 'Номер телефона уже зарегистрирован';
                    }
                }
            }
        }
    } else $err = 'Укажите поле телефон';

    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $ank = $db->selectOne("users", 'id', $user->id);
            if ($ank){
                if ($email != $ank->email){
                    $q = $db->dbquery('users', "`email` = '".$email."' AND `id` != '".$ank->id."'");
                    $res = mysqli_num_rows($q);
                    if ($res > 0)$err = 'Email уже зарегистрирован';
                }
            }
        } else $err = 'Не валидный Email';
    } else $err = 'Вы не указали Email';

    if (!empty($_POST['password'])) {
        $password = str_replace(' ', '', $_POST['password']);
        $pass = md5($password);
        if (strlen($password) > 32)$err = 'Пароль не более 32 символов';
        if (strlen($password) < 6)$err = 'Пароль не менее 6 символов';

    } else $err = 'Укажите пароль';

    if (!empty($_POST['address'])){
        if (strlen($_POST['address']) > 255)$err = 'Не могу разобрать адрес доставки';
    }

    if (!isset($err)){
        $address = strip_tags($_POST['address']);
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
            'pass' => $pass,
            'address' => $address
        );
        $db->update('users', $data, $user->id);
        echo json_encode(array('result' => 'success'));

    } else echo json_encode(array('result' => 'error', 'msg' => $err));


} else echo json_encode(array('result' => 'error', 'msg' => 'Вы не авторизованы'));