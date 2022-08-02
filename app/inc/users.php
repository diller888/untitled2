<?php
require 'func/class.user.php';

if (isset($sess->user_id)) {
    $db->where("id", $sess->user_id);
    $user = $db->ObjectBuilder()->getOne("users");
} elseif (isset($_COOKIE['id_user'])) {
    $db->where("id", $_COOKIE['id_user']);
    $user = $db->ObjectBuilder()->getOne("users");
    $sess->user_id = $user->id;
}

/**
 * Определение гостя
 */
if (isset($sess->guest_id)) {
    $db->where("id", $sess->guest_id);
    $guest = $db->ObjectBuilder()->getOne("guest");
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
    $db->where("id", $_COOKIE['guest_id']);
    $guest = $db->ObjectBuilder()->getOne("guest");
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
            $db->where("id", $idGuest);
            $guest = $db->ObjectBuilder()->getOne("guest");
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
    $db->where('id', $user->id);
    $db->update('users', $dataUser);
}

/**
 * Обновление гостя
 */

if (isset($guest)) {
    $dataGuest = array(
        "date_last" => $time,
    );
    $db->where('id', $guest->id);
    $db->update('guest', $dataGuest);
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

$db->where("date_last < " . (time() - 86400));
$db->where("id_user", "0");
$guestQuery = $db->get('guest', 100);
if ($db->count > 0) {
    foreach ($guestQuery as $guestRow) {
        $db->where('id', $guestRow['id']);
        $db->delete('guest');
    }
}