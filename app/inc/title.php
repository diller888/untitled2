<?php

$act = isset($_GET['act']) ? trim($_GET['act']) : '';
switch ($act) {
    
    case 'err':
        $title = 'Ошибка';
    break;
    default;
        if (isset($_GET['act']) && strlen($_GET['act']) > 0) {

            //модули
            $db->where("link", $_GET['act']);
            $moduls = $db->ObjectBuilder()->getOne("moduls");

            if ($moduls){

                if (file_exists(H.'moduls/'.$moduls->link.'/title.php')){
                    include_once H.'moduls/'.$moduls->link.'/title.php';
                } else {
                    include_once H.'moduls/media/title.php';
                }

            } else {

                $titles = 'Страница не существует';
                header("HTTP/1.0 404 Not Found");
                header("Status: 404 Not Found");
                header("Content-type: text/html",NULL,'404');

            }

        } else {

            $title = $set->title;

        }

}