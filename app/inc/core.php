<?php
define("M", $_SERVER["DOCUMENT_ROOT"] . '/moduls/');
if (file_exists(H . 'tpl/' . (isset($set->tpl) ? $set->tpl : 'default') . '/them.name')) {
    define("TPL", $_SERVER["DOCUMENT_ROOT"] . '/tpl/' . (isset($set->tpl) ? $set->tpl : 'default').'/moduls/');
    define("PATH", "/tpl/" . (isset($set->tpl) ? $set->tpl : 'default')."/moduls/");
} else {
    define("TPL", $_SERVER["DOCUMENT_ROOT"] . '/moduls/');
    define("PATH", "/moduls/");
}
require 'func/session.php';

$sess = Session::getInstance();

//Конфигурация сайта
$set_dinamic = array();
if ($fset = @file_get_contents(H . 'app/data/config.dat')) {
    $set_dinamic = unserialize($fset);
} else {
    header("Location: /install");
    exit;
}
$set = (object) $set_dinamic;

//Подключение к бд
require_once H . 'app/inc/func/base/mainDB.php';
$db = new mainDB($set->mysql_host, $set->mysql_user, $set->mysql_pass, $set->mysql_base);

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

if ($_SERVER['REMOTE_ADDR']){
    $iplong = ip2long($_SERVER['REMOTE_ADDR']);
} else $iplong = false;

//Определение AJAX запроса
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $isAjax = true;
} else $isAjax = false;

//загрузка классов
$loadClass = opendir(H . 'app/class/');
while ($fileclass = readdir($loadClass)) {
    if (preg_match('#\.php$#i', $fileclass)) require_once H . 'app/class/' . $fileclass;
}
