<?php
require 'func/class.user.php';

if (isset($_SESSION['user_id'])) {
    $user = $db->selectOne("users", "id", $_SESSION['user_id']);
} elseif (isset($_COOKIE['id_user'])) {
    $user = $db->selectOne("users", "id", $_COOKIE['id_user']);
    $_SESSION['user_id'] = $user->id;
}

/**
 * Определение гостя
 */

if (isset($_SESSION['id_guest'])) {
    $guest = $db->selectOne("guest", "id", $_SESSION['id_guest']);
    if (!$guest) {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $userAgent = $_SERVER['HTTP_USER_AGENT'];
            require 'func/Browzer.php';
            $browser = new Browser();
            $browzer = $browser->getBrowser();
            $OS = $browser->getPlatform();
            if (isset($_SERVER["HTTP_REFERER"])) {
                $refer = $_SERVER["HTTP_REFERER"];
                $_SESSION['refer'] = $refer;
            } else echo $refer = '';

            $dataGuestReg = isset($_SESSION['date_reg']) ? $_SESSION['date_reg'] : $time;
            $dataGuestName = isset($_SESSION['name']) ? $_SESSION['name'] : '';
            $dataGuestPhone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';
            $dataGuestAddress = isset($_SESSION['address']) ? $_SESSION['address'] : '';
            $dataGuestEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            $dataGuest = array(
                "id" => $_SESSION['id_guest'],
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
            $_SESSION['id_guest'] = $idGuest->id;
            $_SESSION['date_reg'] = $dataGuestReg;
            $_SESSION['name'] = $dataGuestName;
            $_SESSION['phone'] = $dataGuestPhone;
            $_SESSION['address'] = $dataGuestAddress;
            $_SESSION['email'] = $dataGuestEmail;
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
                $_SESSION['refer'] = $refer;
            } else echo $refer = '';

            $dataGuestReg = isset($_SESSION['date_reg']) ? $_SESSION['date_reg'] : $time;
            $dataGuestName = isset($_SESSION['name']) ? $_SESSION['name'] : '';
            $dataGuestPhone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';
            $dataGuestAddress = isset($_SESSION['address']) ? $_SESSION['address'] : '';
            $dataGuestEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
            $dataGuest = array(
                "id" => $_SESSION['id_guest'],
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
            $_SESSION['id_guest'] = $guest->id;
            $_SESSION['date_reg'] = $dataGuestReg;
            $_SESSION['name'] = $dataGuestName;
            $_SESSION['phone'] = $dataGuestPhone;
            $_SESSION['address'] = $dataGuestAddress;
            $_SESSION['email'] = $dataGuestEmail;
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
            $_SESSION['refer'] = $refer;
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
        $_SESSION['id_guest'] = $idGuest;
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