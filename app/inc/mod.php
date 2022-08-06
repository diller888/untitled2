<?php
/**
 * Роутинг Diller Smart CMS
 * Автор Ильдар Русланович
 */
//Ajax запрос заголовков для динамической замены
if (isset($_GET['infoTitle'])) {
    $act = isset($_GET['act']) ? trim($_GET['act']) : '';
    switch ($act) {

        case 'err':
            $array = array();
            include_once M . 'err/title.php';
            echo json_encode(array('title' => $title, 'result' => 'success'));
            break;
        default;

            if (isset($act) && strlen($act) > 0) {

                //модули
                $moduls = $db->selectOne("moduls", "link", $act);

                $array = array();
                if ($moduls) {

                    if (file_exists(TPL . $moduls->link . '/title.php')) {

                        include_once TPL . $moduls->link . '/title.php';

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
                        if (file_exists(TPL . $moduls->link . '/js/' . $fileName . 'main.js')) {
                            $array['result'] = 'success';
                            $array['path'] = PATH . $moduls->link . '/js/' . $fileName . 'main.js?d=' . (microtime(true));
                        }
                        if (user_access('owner') && file_exists(TPL . $moduls->link . '/js/' . $fileName . 'owner.js')) {
                            $array['result'] = 'success';
                            $array['owner'] = PATH . $moduls->link . '/js/' . $fileName . 'owner.js?d=' . (microtime(true));
                        }

                    } elseif (file_exists(M . $moduls->link . '/title.php')) {

                        include_once M . $moduls->link . '/title.php';

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
                        if (file_exists(M . $moduls->link . '/js/' . $fileName . 'main.js')) {
                            $array['result'] = 'success';
                            $array['path'] = '/moduls/' . $moduls->link . '/js/' . $fileName . 'main.js?d=' . (microtime(true));
                        }
                        if (user_access('owner') && file_exists(M . $moduls->link . '/js/' . $fileName . 'owner.js')) {
                            $array['result'] = 'success';
                            $array['owner'] = '/moduls/' . $moduls->link . '/js/' . $fileName . 'owner.js?d=' . (microtime(true));
                        }
                    } else {
                        include_once M . 'err/title.php';
                        $array['title'] = $title;
                        $array['result'] = 'error';
                    }

                } else {
                    include_once M . 'err/title.php';
                    $array['title'] = $title;
                    $array['result'] = 'error';
                }

            } else {

                if (file_exists(TPL . 'main/js/main.js')) {
                    $array['result'] = 'success';
                    $array['path'] = PATH .'main/js/main.js';
                } elseif (file_exists(M . 'main/js/main.js')) {
                    $array['result'] = 'success';
                    $array['path'] = '/moduls/main/js/main.js';
                }
                if (user_access('owner') && file_exists(TPL . 'main/js/owner.js')) {
                    $array['result'] = 'success';
                    $array['owner'] = PATH .'main/js/owner.js';
                } elseif (user_access('owner') && file_exists(M . 'main/js/owner.js')) {
                    $array['result'] = 'success';
                    $array['owner'] = '/moduls/main/js/owner.js';
                }
                $array['title'] = $set->title;

            }
            echo json_encode($array);
    }

} else {

    if (file_exists(TPL . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/css/main.css')) {
        $loadCss = opendir(TPL . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/css/');
        while ($filecss = readdir($loadCss)) {
            if (preg_match('#.css$#i', $filecss)) echo "		<link type="text/css" rel="stylesheet" href='" . PATH . (isset($_GET['act']) ? $_GET['act'] : 'main') . "/css/" . $filecss . "'>
";
        }
    } elseif (file_exists(M . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/css/main.css')) {
        $loadCss = opendir(M . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/css/');
        while ($filecss = readdir($loadCss)) {
            if (preg_match('#.css$#i', $filecss)) echo "		<link type="text/css" rel="stylesheet" href='/moduls/" . (isset($_GET['act']) ? $_GET['act'] : 'main') . "/css/" . $filecss . "'>
";
        }
    }

    $act = isset($_GET['act']) ? trim($_GET['act']) : '';
    switch ($act) {

        case 'err':
            $mod_link = 'err/index.php';
            echo "\t\t<link type=\"text/css\" rel=\"stylesheet\" href='/moduls/err/css/main.css'>\n";
            break;

        case 'go':
            $locationHref = str_replace('https:/', 'https://', $_GET['id']);
            $locationHref = str_replace('http:/', 'http://', $locationHref);
            header("Location: " . $locationHref);
            exit;
            break;

        default;
            if (isset($_GET['act']) && strlen($_GET['act']) > 0) {

                //модули
                $moduls = $db->selectOne("moduls", "link", $_GET['act']);

                //если есть подключенные модули
                if ($moduls) {

                    //если пришла переменная id (пример адреса site.ru/act/id)
                    if (isset($_GET['id']) && strlen($_GET['id']) > 0) {

                        //если пришла переменная sid (пример адреса site.ru/act/id/item/sid)
                        if (isset($_GET['sid']) && strlen($_GET['sid']) > 0) {

                            if (file_exists(TPL . $moduls->link . '/column.php')) {
                                $mod_link = $moduls->link . '/column.php';
                            } elseif (file_exists(M . $moduls->link . '/column.php')) {
                                $mod_link = $moduls->link . '/column.php';
                            } else {
                                $mod_link = 'err/index.php';
                            }

                            //если пришла переменная item (пример адреса site.ru/act/id/item)
                        } elseif (isset($_GET['item']) && strlen($_GET['item']) > 0) {

                            if (file_exists(TPL . $moduls->link . '/item.php')) {
                                $mod_link = $moduls->link . '/item.php';
                            } elseif (file_exists(M . $moduls->link . '/item.php')) {
                                $mod_link = $moduls->link . '/item.php';
                            } else {
                                $mod_link = 'err/index.php';
                            }

                        } else {

                            //проверяем есть ли в папке файл модуля, если нет подгрузим стандартный модуль из папки media
                            if (file_exists(TPL . $moduls->link . '/list.php')) {
                                $mod_link = $moduls->link . '/list.php';
                            } elseif (file_exists(M . $moduls->link . '/list.php')) {
                                $mod_link = $moduls->link . '/list.php';
                            } else {
                                $mod_link = 'err/index.php';
                            }

                        }

                    } else {

                        //если пришла только переменная act
                        if (file_exists(TPL . $moduls->link . '/index.php')) {
                            $mod_link = $moduls->link . '/index.php';
                        } elseif (file_exists(M . $moduls->link . '/index.php')) {
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

        if (isset($mod_link) && file_exists(TPL . $mod_link)) {
            require_once TPL . $mod_link;
        } elseif (file_exists(M . $mod_link)) {
            require_once M . $mod_link;
        } elseif (file_exists(TPL . $_GET['act'] . '/index.php')) {
            require_once TPL . $_GET['act'] . '/index.php';
        } elseif (file_exists(M . $_GET['act'] . '/index.php')) {
            require_once M . $_GET['act'] . '/index.php';
        } else {
            echo "\t\t<link type=\"text/css\" rel=\"stylesheet\" href='/moduls/err/css/main.css'>\n";
            require_once M . 'err/index.php';
        }

    } catch (Exception $e) {

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

    }
}
