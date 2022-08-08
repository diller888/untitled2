<?php

if (isset($_GET['list']) && strlen($_GET['list']) > 0) {
    $ank = $db->selectOne("users", "id", $_GET['id']);
    if (isset($user) && $user->id == $ank->id) {
        $title = fullname($ank->id) . ' | Настройки';
    } else {
        header("Location: /err/404");
        exit;
    }
} elseif (isset($_GET['id']) && strlen($_GET['id']) > 0) {
    $ank = $db->selectOne("users", "id", $_GET['id']);
    if ($ank->id) {
        $title = fullname($ank->id);
    } else {
        header("Location: /err/404");
        exit;
    }
} else {
    if (isset($user)) {
        $title = fullname($user->id);
    } else {
        header("Location: /auth");
        exit;
    }
}
