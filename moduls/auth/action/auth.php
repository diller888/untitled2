<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require_once H. 'app/inc/core.php';

if (!empty($_POST['login'])) {
    if (!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $_POST['login'])) $err = 'В логине присутствуют запрещенные символы';
    if (preg_match("#[a-z]+#ui", $_POST['login']) && preg_match("#[а-я]+#ui", $_POST['login'])) $err = 'Разрешается использовать символы только русского или только английского алфавита';
    if (preg_match("#(^\ )|(\ $)#ui", $_POST['login'])) $err = 'Запрещено использовать пробел в начале и конце ника';
    if (strlen($_POST['login']) < 4) $err = 'Короткий логин';
    if (strlen($_POST['login']) > 64) $err = 'Длина логина превышает 64 символа';
    $login = $_POST['login'];
} else {
    $err = 'Вы не ввели логин';
}
if (!empty($_POST['password'])) {
    if (strlen($_POST['password']) < 6) $err = 'По соображениям безопасности пароль не может быть короче 6-ти символов';
    if (strlen($_POST['password']) > 32) $err = 'Длина пароля превышает 32 символа';
    $password = $_POST['password'];
} else {
    $err = 'Вы не ввели пароль';
}
if (!empty($_POST['chislo'])) {
    $chislo = intval($_POST['chislo']);
    if (strlen($chislo) != 5) $err = 'Не указано проверочное число';
    if ($chislo != $sess->captcha) $err = 'Не верно указано проверочное число';
} else {
    $err = 'Вы не ввели проверочное число';
}

if (!isset($err)) {
    $db->where("login", $login);
    $ank = $db->ObjectBuilder()->getOne("users");
    if ($ank->login === $login && $ank->password === $password) {
        $sess->user_id = $ank->id;
        setcookie('user_id', $ank->id, time() + 864000000, '/');
        echo json_encode(array('result' => 'success'));
    } else {
        if ($ank->email === $login && $ank->password === $password) {
            $sess->user_id = $ank->id;
            setcookie('user_id', $ank->id, time() + 864000000, '/');
            echo json_encode(array('result' => 'success'));
        } else {
            if ($ank->phone === $login && $ank->password === $password) {
                $sess->user_id = $ank->id;
                setcookie('user_id', $ank->id, time() + 864000000, '/');
                echo json_encode(array('result' => 'success'));
            } else {
                echo json_encode(array('result' => 'error', 'msg' => 'Bad request'));
            }
        }
    }
} else {
    echo json_encode(array('result' => 'error', 'msg' => $err));
}