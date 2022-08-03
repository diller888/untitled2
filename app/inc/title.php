<?php

$act = isset($_GET['act']) ? trim($_GET['act']) : '';
switch ($act) {

    case 'exit':
        require_once M . 'auth/exit.php';
        break;
    case 'err':
        include_once M . 'err/title.php';
        break;
    default;
        if (isset($_GET['act']) && strlen($_GET['act']) > 0) {

            //модули
            $moduls = $db->selectOne("moduls", "link", $_GET['act']);

            if ($moduls) {

                if (file_exists(M . $moduls->link . '/title.php')) {
                    include_once M . $moduls->link . '/title.php';
                } else {
                    include_once M . 'err/title.php';
                }

            } else {

                include_once M . 'err/title.php';

            }

        } else {

            $title = $set->title;

        }
}
