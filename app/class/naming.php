<?
function fisrtname($ID)
{

    global $db;
    $ank = $db->selectOne("users", "id", $ID);
    $ankname = explode(' ', $ank->name);
    if (isset($ankname[0])) {
        $name = $ankname[0];
    } else {
        $name = $ank->name;
    }
    $name = (strlen($ank->name) > 2 ? $name : $ank->login);

    return $name;

}

function fullname($ID)
{

    global $db;

    $ank = $db->selectOne("users", "id", $ID);
    $name = (strlen($ank->name) > 2 ? $ank->name : $ank->login);

    return $name;

}


function user_name($ID)
{

    global $db;

    $ank = $db->selectOne("users", "id", $ID);

    $string = explode(' ', $ank->name);
    $name = $string[0];
    $leight = strlen($name) / 2;
    $num = ceil($leight) - 1;
    $num2 = ceil($leight) - 2;
    $str = mb_substr($name, 0, -1, 'UTF-8');
    $one = mb_substr($name, $num, 1, 'UTF-8');
    $str_two = mb_substr($name, 0, -2, 'UTF-8');
    $two = mb_substr($name, $num2, 2, 'UTF-8');

    if ($ank->pol == 0) {

        if ($one == 'я') {
            $name = $str . 'и';
        } elseif ($one == 'а') {
            $name = $str . 'ы';
        } elseif ($one == 'й') {
            $name = $str . 'я';
        } elseif ($one == 'ь') {
            $name = $str . 'я';
        } else {
            $name = $name . 'а';
        }

    } elseif ($ank->pol == 1) {

        if ($two == 'ый') {
            $name = $str_two . 'ого';
        } elseif ($one == 'й') {
            $name = $str . 'я';
        } elseif ($one == 'а') {
            $name = $str . 'ы';
        } elseif ($one == 'ь') {
            $name = $str . 'я';
        } else {
            $name = $name . 'ы';
        }

    } else $name = $name;

    return $name;

}


function city_name($str)
{

    $string = explode(' ', $str);
    $name = $string[0];
    $leight = strlen($name) / 2;
    $num = ceil($leight) - 1;
    $num2 = ceil($leight) - 2;
    $str = mb_substr($name, 0, -1, 'UTF-8');
    $one = mb_substr($name, $num, 1, 'UTF-8');
    $str_two = mb_substr($name, 0, -2, 'UTF-8');
    $two = mb_substr($name, $num2, 2, 'UTF-8');

    if ($two == 'ль') {
        $name = $str . 'ле';
    } elseif ($two == 'ми') {
        $name = $str . 'ми';
    } elseif ($one == 'я') {
        $name = $str . 'и';
    } elseif ($one == 'а') {
        $name = $str . 'е';
    } elseif ($one == 'ь') {
        $name = $str . 'и';
    } else {
        $name = $name . 'е';
    }

    return $name;

}
