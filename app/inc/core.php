<?php
require 'func/session.php';

$sess = Session::getInstance();

$set_dinamic = array();

if ($fset = @file_get_contents(H . 'app/data/config.dat')) {
    $set_dinamic = unserialize($fset);
} else {
    header("Location: /install");
    exit;
}
$set = (object) $set_dinamic;

//Подключение к бд
require_once H . "app/vendor/thingengineer/mysqli-database-class/MysqliDb.php";
$db = new MysqliDb($set->mysql_host, $set->mysql_user, $set->mysql_pass, $set->mysql_base);

$time = time();

//Функция времени
function vremja($time = NULL)
{
    global $item;
    if ($time == NULL) $time = time();
    if (isset($set->timeZone) && $set->timeZone > 0) $time = $time + $set->timeZone * 60 * 60;
    $timep = date("j M Y в H:i", $time);
    $time_p[0] = date("j n Y", $time);
    $time_p[1] = date("H:i", $time);
    if ($time_p[0] == date("j n Y")) $timep = date("H:i:s", $time);
    if ($time_p[0] == date("j n Y", time() - 60 * 60 * 24)) $timep = "Вчера в $time_p[1]";

    $timep = str_replace("Jan", "янв", $timep);
    $timep = str_replace("Feb", "фев", $timep);
    $timep = str_replace("Mar", "мар", $timep);
    $timep = str_replace("May", "мая", $timep);
    $timep = str_replace("Apr", "апр", $timep);
    $timep = str_replace("Jun", "июн", $timep);
    $timep = str_replace("Jul", "июл", $timep);
    $timep = str_replace("Aug", "авг", $timep);
    $timep = str_replace("Sep", "сен", $timep);
    $timep = str_replace("Oct", "окт", $timep);
    $timep = str_replace("Nov", "ноя", $timep);
    $timep = str_replace("Dec", "дек", $timep);

    return $timep;
}
//Функция времени для поста
function ex_time($time = NULL)
{
    global $user;
    if ($time == NULL) $time = time();
    if (isset($user)) $time = $time + $user['timeZone'] * 60 * 60;
    $timep = date("j M Y", $time);
    $time_p[0] = date("j n Y", $time);
    $time_p[1] = date("H:i", $time);
    if ($time_p[0] == date("j n Y")) $timep = date("H:i:s", $time);
    if (isset($user)) {
        if ($time_p[0] == date("j n Y", time() + $user['timeZone'] * 60 * 60)) $timep = date("H:i:s", $time);
        if ($time_p[0] == date("j n Y", time() - 60 * 60 * (24 - $user['timeZone']))) $timep = "Вчера в $time_p[1]";
    } else {
        if ($time_p[0] == date("j n Y")) $timep = date("H:i:s", $time);
        if ($time_p[0] == date("j n Y", time() - 60 * 60 * 24)) $timep = "Вчера в $time_p[1]";
    }
    $timep = str_replace("Jan", "января", $timep);
    $timep = str_replace("Feb", "февраля", $timep);
    $timep = str_replace("Mar", "марта", $timep);
    $timep = str_replace("May", "мая", $timep);
    $timep = str_replace("Apr", "апреля", $timep);
    $timep = str_replace("Jun", "июня", $timep);
    $timep = str_replace("Jul", "июля", $timep);
    $timep = str_replace("Aug", "августа", $timep);
    $timep = str_replace("Sep", "сентября", $timep);
    $timep = str_replace("Oct", "октября", $timep);
    $timep = str_replace("Nov", "ноября", $timep);
    $timep = str_replace("Dec", "декабря", $timep);
    return $timep;
}

function post_mounth($time = NULL)
{
    $timep = date("M", $time);
    $timep = str_replace("Jan", "Янв", $timep);
    $timep = str_replace("Feb", "Фев", $timep);
    $timep = str_replace("Mar", "Мар", $timep);
    $timep = str_replace("May", "Мая", $timep);
    $timep = str_replace("Apr", "Апр", $timep);
    $timep = str_replace("Jun", "Июн", $timep);
    $timep = str_replace("Jul", "Июл", $timep);
    $timep = str_replace("Aug", "Авг", $timep);
    $timep = str_replace("Sep", "Сен", $timep);
    $timep = str_replace("Oct", "Окт", $timep);
    $timep = str_replace("Nov", "Ноя", $timep);
    $timep = str_replace("Dec", "Дек", $timep);
    return $timep;
}

function post_date($time = NULL)
{
    $timep = date("j", $time);
    return $timep;
}

function post_year($time = NULL)
{
    $timep = date("Y", $time);
    return $timep;
}

//Вывод ошибок
function err()
{
    global $err;
    if (isset($err)) {
        if (is_array($err)) {
            foreach ($err as $key => $value) {
                echo "<div class='hs-error'>$value</div>\n";
            }
        } else echo "<div class='hs-error'>$err</div>\n";
    }
}
//определение ip
$ipa = false;

if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '127.0.0.1' && preg_match("#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#", $_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip2['xff'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
    $ipa[] = $_SERVER['HTTP_X_FORWARDED_FOR'];
}

if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '127.0.0.1' && preg_match("#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#", $_SERVER['HTTP_CLIENT_IP'])) {
    $ip2['cl'] = $_SERVER['HTTP_CLIENT_IP'];
    $ipa[] = $_SERVER['HTTP_CLIENT_IP'];
}

if (isset($_SERVER['REMOTE_ADDR']) && preg_match("#^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$#", $_SERVER['REMOTE_ADDR'])) {
    $ip2['add'] = $_SERVER['REMOTE_ADDR'];
    $ipa[] = $_SERVER['REMOTE_ADDR'];
}

$ip = $ipa[0];
$iplong = ip2long($ip);

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $isAjax = true;
} else {
    $isAjax = false;
}
//загрузка классов
$loadClass = opendir(H . 'app/class/');
while ($fileclass = readdir($loadClass)) {
    if (preg_match('#\.php$#i', $fileclass)) require_once H . 'app/class/' . $fileclass;
}
