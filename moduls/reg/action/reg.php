<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require_once H . 'app/inc/core.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dataUser = array();
    if (!empty($_POST['login'])) {
        if (!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $_POST['login'])) $err = 'В логине присутствуют запрещенные символы';
        if (preg_match("#[a-z]+#ui", $_POST['login']) && preg_match("#[а-я]+#ui", $_POST['login'])) $err = 'Разрешается использовать символы только русского или только английского алфавита';
        if (preg_match("#(^\ )|(\ $)#ui", $_POST['login'])) $err = 'Запрещено использовать пробел в начале и конце ника';
        if (strlen($_POST['login']) < 4) $err = 'Короткий логин';
        if (strlen($_POST['login']) > 64) $err = 'Длина логина превышает 64 символа';
        $ank = $db->selectOne("users", "login", $_POST['login']);
        $login = $_POST['login'];
        if ($ank['login'] === $login) $err = 'Логин занят';
        array_push($dataUser, 'login', $login);
    } else $err = 'Не указан логин';

    if (!empty($_POST['password'])) {
        if (strlen($_POST['password']) < 6) $err = 'Пароль меньше 6 символов';
        if (strlen($_POST['password']) < 6) $err = 'Пароль не может быть короче 6 символов';
        if (strlen($_POST['password']) > 32) $err = 'Длина пароля превышает 32 символа';
        $password = $_POST['password'];
        $pass = md5($_POST['password']);
        array_push($dataUser, 'pass', $pass);
        array_push($dataUser, 'password', $password);
    } else $err = 'Не указан пароль';

    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (strlen($_POST['email']) > 8) {
                $ankEmail = $db->selectOne("users", "email", $_POST['email']);
                if ($ankEmail->email === $_POST['email']) {
                    $err = 'email уже зарегистрирован';
                } else
                    array_push($dataUser, 'email', $_POST['email']);
            } else $err = 'Заполните поле email';
        } else $err = 'Не валидный email';
    } else $err = 'Не указан email';

    if (!empty($_POST['phone'])) {
        $phones = preg_replace("/[^,.0-9]/", '', $_POST['phone']);
        if (strlen($phones) > 10) {
            $ankphone = $db->selectOne("users", "phone", $phones);
            if ($ankphone->phone === $phones) {
                $err = 'Номер телефона уже зарегистрирован';
            } else
                array_push($dataUser, 'phone', $phones);
        } else $err = 'Укажите номер телефона';
    } else $err = 'Не указан телефон';

    if (!empty($_POST['chislo'])) {
        $chislo = intval($_POST['chislo']);
        if (strlen($chislo) != 5) $err = 'Не указано проверочное число';
        if ($chislo != $sess->captcha) $err = 'Не верно указано проверочное число';
    } else $err = 'Вы не ввели проверочное число';
    //Если нет ошибок
    /**
     * if (!isset($err)) {
     * $idUser = $db->insert('users', $dataUser);
     * if ($idUser) {
     * $sess->user_id = $idUser;
     * setcookie('user_id', $idUser, time() + 864000000, '/');
     * if (!empty($_POST['email'])) {
     * //Отправка письма на email
     * require_once H . 'moduls/reg/action/send.php';
     * }
     * echo json_encode(array('result' => 'success'));
     * } else echo json_encode(array('result' => 'error', 'msg' => 'Произошла внутренняя ошибка'));
     *
     * } else echo json_encode(array('result' => 'error', 'msg' => $err));
     */

} else echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'));
