<?php

if (isset($_GET['infoTitle'])) {
    $act = isset($_GET['act']) ? trim($_GET['act']) : '';
    switch ($act) {

        case 'err':
            $array = array();
            echo json_encode(array('title' => 'Ошибка', 'result' => 'success'));
            break;
        default;

            if (isset($_GET['act']) && strlen($_GET['act']) > 0) {

                //модули
                $db->where("link", $_GET['act']);
                $moduls = $db->ObjectBuilder()->getOne("moduls");

                $array = array();
                if ($moduls) {

                    if (file_exists(H . 'moduls/' . $moduls->link . '/title.php')) {

                        include_once H . 'moduls/' . $moduls->link . '/title.php';

                        $array['title'] = $title;

                        if (isset($_GET['cid']) && strlen($_GET['cid']) > 0) {
                            $fileName = 'column_';
                        } elseif (isset($_GET['item']) && strlen($_GET['item']) > 0) {
                            $fileName = 'item_';
                        } elseif (isset($_GET['list']) && strlen($_GET['list']) > 0) {
                            $fileName = 'list_';
                        } elseif (isset($_GET['id']) && strlen($_GET['id']) > 0) {
                            $fileName = 'row_';
                        } else {
                            $fileName = '';
                        }
                        if (file_exists(H . 'moduls/' . $moduls->link . '/js/' . $fileName . 'main.js')) {
                            $array['result'] = 'success';
                            $array['path'] = '/moduls/' . $moduls->link . '/js/' . $fileName . 'main.js';
                        }
                        if (user_access('owner') && file_exists(H . 'moduls/' . $moduls->link . '/js/' . $fileName . 'owner.js')) {
                            $array['result'] = 'success';
                            $array['owner'] = '/moduls/' . $moduls->link . '/js/' . $fileName . 'owner.js';
                        }

                    } else {
                        $array['title'] = 'Страница не существует';
                        $array['result'] = 'error';
                    }

                } else {
                    $array['title'] = 'Страница не существует';
                    $array['result'] = 'error';
                }

            } else {

                if (file_exists(H . 'moduls/main/js/main.js')) {
                    $array['result'] = 'success';
                    $array['path'] = '/moduls/main/js/main.js';
                }
                if (user_access('owner') && file_exists(H . 'moduls/main/js/owner.js')) {
                    $array['result'] = 'success';
                    $array['owner'] = '/moduls/main/js/owner.js';
                }
                $array['title'] = $set->title;

            }
            echo json_encode($array);
    }

} else {

    if (file_exists(H . 'moduls/' . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/css/main.css')) {
        $loadCss = opendir(H . 'moduls/' . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/css/');
        while ($filecss = readdir($loadCss)) {
            if (preg_match('#\.css$#i', $filecss)) echo "\t\t<link type=\"text/css\" rel=\"stylesheet\" href='/moduls/" . (isset($_GET['act']) ? $_GET['act'] : 'main') . "/css/" . $filecss . "'>\n";
        }
    }

    $act = isset($_GET['act']) ? trim($_GET['act']) : '';
    switch ($act) {

        case 'err':
            $mod_link = 'err/index.php';
            echo "\t\t<link type=\"text/css\" rel=\"stylesheet\" href='/moduls/err/css/main.css'>\n";
            break;

        case 'exit':
            $mod_link = 'auth/exit.php';
            break;

        default;
            if (isset($_GET['act']) && strlen($_GET['act']) > 0) {

                //модули
                $db->where("link", $_GET['act']);
                $moduls = $db->ObjectBuilder()->getOne("moduls");

                //если есть подключенные модули
                if ($moduls) {

                    //если пришла переменная id (пример адреса site.ru/act/id)
                    if (isset($_GET['id']) && strlen($_GET['id']) > 0) {

                        //если пришла переменная item (пример адреса site.ru/act/id/item)
                        if (isset($_GET['item']) && strlen($_GET['item']) > 0) {

                            if (file_exists(H . 'moduls/' . $moduls->link . '/item.php')) {
                                $mod_link = $moduls['link'] . '/item.php';
                            } else {
                                $mod_link = 'media/item.php';
                            }

                        } else {

                            //проверяем есть ли в папке файл модуля, если нет подгрузим стандартный модуль из папки media
                            if (file_exists(H . 'moduls/' . $moduls->link . '/list.php')) {
                                $mod_link = $moduls['link'] . '/list.php';
                            } else {
                                $mod_link = 'media/list.php';
                            }

                        }

                    } else {

                        //если пришла только переменная act
                        if (file_exists(H . 'moduls/' . $moduls->link . '/index.php')) {
                            $mod_link = $moduls->link . '/index.php';
                        } else {
                            echo "\t\t<link type=\"text/css\" rel=\"stylesheet\" href='/moduls/err/css/main.css'>\n";
                            $mod_link = 'err/index.php';
                        }

                    }

                } else {

                    echo "\t\t<link type=\"text/css\" rel=\"stylesheet\" href='/moduls/err/css/main.css'>\n";
                    $mod_link = 'err/index.php';
                }

            } else {
                $mod_link = 'main/index.php';
            }

    }

    try {

        if (file_exists(H . 'moduls/' . $mod_link)) {
            require_once H . 'moduls/' . $mod_link;
        } elseif (file_exists(H . 'moduls/' . $_GET['act'] . '/index.php')) {
            require_once H . 'moduls/' . $_GET['act'] . '/index.php';
        } else {
            echo "\t\t<link type=\"text/css\" rel=\"stylesheet\" href='/moduls/err/css/main.css'>\n";
            require_once H . 'moduls/err/index.php';
        }

    } catch (Exception $e) {

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
        echo $e->getMessage(), "\n";

    }
}
