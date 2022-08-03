<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require_once H . 'app/inc/core.php';

if (!empty($_POST['login'])) {
    if (!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $_POST['login'])) $err = 'В логине присутствуют запрещенные символы';
    if (preg_match("#[a-z]+#ui", $_POST['login']) && preg_match("#[а-я]+#ui", $_POST['login'])) $err = 'Разрешается использовать символы только русского или только английского алфавита';
    if (preg_match("#(^\ )|(\ $)#ui", $_POST['login'])) $err = 'Запрещено использовать пробел в начале и конце ника';
    if (strlen($_POST['login']) < 4) $err = 'Короткий логин';
    if (strlen($_POST['login']) > 64) $err = 'Длина логина превышает 64 символа';
    $login = $_POST['login'];
    $ank = $db->selectOne("users", "login", $login);
    if ($ank->login === $login) $err = 'Логин занят';
    if (!isset($err)) {
        echo json_encode(array('result' => 'success'));
    } else {
        echo json_encode(array('result' => 'error', 'msg' => $err));
    }
} else {
    echo json_encode(array('result' => 'error', 'msg' => 'Вы не ввели логин'));
}
