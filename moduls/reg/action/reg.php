<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require_once H . 'app/inc/core.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
header('Content-Type: text/html; charset=utf-8');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['login'])) {
        if (!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $_POST['login'])) $err = 'В логине присутствуют запрещенные символы';
        if (preg_match("#[a-z]+#ui", $_POST['login']) && preg_match("#[а-я]+#ui", $_POST['login'])) $err = 'Разрешается использовать символы только русского или только английского алфавита';
        if (preg_match("#(^\ )|(\ $)#ui", $_POST['login'])) $err = 'Запрещено использовать пробел в начале и конце ника';
        if (strlen($_POST['login']) < 4) $err = 'Короткий логин';
        if (strlen($_POST['login']) > 64) $err = 'Длина логина превышает 64 символа';
        $login = $_POST['login'];
        $data = array("login" => $login);
        $ankCount = $db->results("users", $data);
        if ($ankCount > 0) $err = 'Логин занят';
    } else {
        $err = 'Не указан логин';
    }

    if (!empty($_POST['password'])) {
        $password = str_replace(' ', '', $_POST['password']);
        if (strlen($password) < 6) $err = 'Пароль не может быть короче 6 символов';
        if (strlen($password) > 32) $err = 'Длина пароля превышает 32 символа';
        $pass = md5($password);
    } else $err = 'Не указан пароль';

    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (strlen($_POST['email']) > 8) {
                $data = array("email" => $_POST['email']);
                $ankEmail = $db->results("users", $data);
                if ($ankEmail > 0) $err = 'email уже зарегистрирован';
            } else $err = 'Заполните поле email';
        } else $err = 'Не валидный email';
    } else $err = 'Не указан email';

    if (!empty($_POST['phone'])) {
        $phones = preg_replace("/[^,.0-9]/", '', $_POST['phone']);
        if (strlen($phones) > 10) {
            $data = array("phone" => $phones);
            $ankphone = $db->results("users", $data);
            if ($ankphone > 0) $err = 'Номер телефона уже зарегистрирован';
        } else $err = 'Укажите номер телефона';
    } else $err = 'Не указан телефон';

    if (!empty($_POST['chislo'])) {
        $chislo = intval($_POST['chislo']);
        if (strlen($chislo) != 5) $err = 'Не указано проверочное число';
        if ($chislo != $_SESSION['captcha']) $err = 'Не верно указано проверочное число';
    } else $err = 'Вы не ввели проверочное число';
    //Если нет ошибок
    if (!isset($err)) {

        $email = $_POST['email'];
        $dataUser = array(
            'login' => $login,
            'pass' => $pass,
            'password' => $password,
            'level' => 0,
            'group_access' => 1,
            'ip' => $iplong,
            'date_reg' => $time,
            'email' => $email,
            'phone' => $phones
        );
        $idUser = $db->insert('users', $dataUser);
        if ($idUser) {
            $_SESSION['user_id'] = $idUser;
            setcookie('user_id', $idUser, time() + 864000000, '/');
            if (!empty($_POST['email'])) {
                //Отправка письма на email
                require_once H . 'moduls/reg/action/send.php';
            }
            echo json_encode(array('result' => 'success'));
        } else echo json_encode(array('result' => 'error', 'msg' => 'Произошла внутренняя ошибка'), JSON_UNESCAPED_UNICODE);

    } else echo json_encode(array('result' => 'error', 'msg' => $err), JSON_UNESCAPED_UNICODE);


} else echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'), JSON_UNESCAPED_UNICODE);
