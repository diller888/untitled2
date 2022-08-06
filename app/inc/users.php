<?php
require 'func/class.user.php';

if (isset($sess->user_id)) {
    $user = $db->selectOne("users", "id", $sess->user_id);
} elseif (isset($_COOKIE['id_user'])) {
    $user = $db->selectOne("users", "id", $_COOKIE['id_user']);
    $sess->user_id = $user->id;
}

/**
 * Определение гостя
 */

if (isset($sess->guest_id)) {
    $guest = $db->selectOne("guest", "id", $sess->guest_id);
    if (!$guest) {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            require 'func/Browzer.php';
            $browser = new Browser();
            $browzer = $browser->getBrowser();
            $OS = $browser->getPlatform();
            if (isset($_SERVER["HTTP_REFERER"])) {
                $refer = $_SERVER["HTTP_REFERER"];
                $sess->refer = $refer;
            } else echo $refer = '';

            $dataGuestReg = isset($sess->date_reg) ? $sess->date_reg : $time;
            $dataGuestName = isset($sess->name) ? $sess->name : '';
            $dataGuestPhone = isset($sess->phone) ? $sess->phone : '';
            $dataGuestAddress = isset($sess->address) ? $sess->address : '';
            $dataGuestEmail = isset($sess->email) ? $sess->email : '';
            $dataGuest = array(
                "id" => $sess->guest_id,
                "name" => $dataGuestName,
                "email" => $dataGuestEmail,
                "phone" => $dataGuestPhone,
                "date_reg" => $dataGuestReg,
                "date_last" => $time,
                "agent" => $userAgent,
                "browser" => $browzer,
                "os" => $OS,
                "address" => $dataGuestAddress
            );
            $idGuest = $db->insert('guest', $dataGuest);
            $guest = $db->selectOne("guest", "id", $idGuest);
            $sess->guest_id = $idGuest->id;
            $sess->date_reg = $dataGuestReg;
            $sess->name = $dataGuestName;
            $sess->phone = $dataGuestPhone;
            $sess->address = $dataGuestAddress;
            $sess->email = $dataGuestEmail;
            setcookie('guest_id', $idGuest->id, time()+864000000, '/');
        }
    }
} elseif (isset($_COOKIE['guest_id'])) {
    $guest = $db->selectOne("guest", "id", $_COOKIE['guest_id']);
    if (!$guest) {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            require 'func/Browzer.php';
            $browser = new Browser();
            $browzer = $browser->getBrowser();
            $OS = $browser->getPlatform();
            if (isset($_SERVER["HTTP_REFERER"])) {
                $refer = $_SERVER["HTTP_REFERER"];
                $sess->refer = $refer;
            } else echo $refer = '';

            $dataGuestReg = isset($sess->date_reg) ? $sess->date_reg : $time;
            $dataGuestName = isset($sess->name) ? $sess->name : '';
            $dataGuestPhone = isset($sess->phone) ? $sess->phone : '';
            $dataGuestAddress = isset($sess->address) ? $sess->address : '';
            $dataGuestEmail = isset($sess->email) ? $sess->email : '';
            $dataGuest = array(
                "id" => $sess->guest_id,
                "name" => $dataGuestName,
                "email" => $dataGuestEmail,
                "phone" => $dataGuestPhone,
                "date_reg" => $dataGuestReg,
                "date_last" => $time,
                "agent" => $userAgent,
                "browser" => $browzer,
                "os" => $OS,
                "address" => $dataGuestAddress
            );
            $idGuest = $db->insert('guest', $dataGuest);
            $guest = $db->selectOne("guest", "id", $idGuest);
            $sess->guest_id = $guest->id;
            $sess->date_reg = $dataGuestReg;
            $sess->name = $dataGuestName;
            $sess->phone = $dataGuestPhone;
            $sess->address = $dataGuestAddress;
            $sess->email = $dataGuestEmail;
            setcookie('guest_id', $idGuest, time()+864000000, '/');
        }
    }
} else {
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        require 'func/Browzer.php';
        $browser = new Browser();
        $browzer = $browser->getBrowser();
        $OS = $browser->getPlatform();
        if (isset($_SERVER["HTTP_REFERER"])) {
            $refer = $_SERVER["HTTP_REFERER"];
            $sess->refer = $refer;
        } else echo $refer = '';
        $dataGuest = array(
            "date_reg" => $time,
            "date_last" => $time,
            "agent" => $userAgent,
            "browser" => $browzer,
            "os" => $OS
        );
        $idGuest = $db->insert('guest', $dataGuest);
        $guest = $db->selectOne("guest", "id", $idGuest);
        $sess->guest_id = $idGuest;
        setcookie('guest_id', $idGuest, time()+864000000, '/');

    }
}

/**
 * Обновление пользователя
 */

if (isset($user)) {
    $dataUser = array(
        "date_last" => $time,
    );
    $db->update('users', $dataUser, $user->id);
}

/**
 * Обновление гостя
 */

if (isset($guest)) {
    $dataGuest = array(
        "date_last" => $time,
    );
    $db->update('guest', $dataGuest, $guest->id);
} else {
    $guest_data[] = '';
    $guest_data['id'] = 0;
    $guest_data['ip'] = 0;
    $guest_data['name'] = '';
    $guest_data['phone'] = '';
    $guest_data['email'] = '';
    $guest_data['sort'] = 0;
    $guest_data = (object)$guest_data;
}

$params = "`date_last` < " . (time() - 86400) . " AND `id_user` = '0'";
$guestQuery = $db->dbquery('guest', $params, 100);
if ($guestQuery) {
    while ($guestRow = mysqli_fetch_array($guestQuery)){
        $db->delete('guest', $guestRow['id']);
    }
}