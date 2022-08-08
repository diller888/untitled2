<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';

if ($user) {
    if (isset($_FILES['file'])) {

        $ras = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $new_name = substr_replace(sha1(microtime(true)), '', 12);
        $uploadfile = $new_name . "." . $ras;

        if ($ras == 'jpg' || $ras == 'png' || $ras == 'gif' || $ras == 'jpeg' || $ras == 'webp') {

            // Директория, куда будут загружаться файлы.
            $dirUsers = H . '/uploads/users/';
            if (!is_dir($dirUsers)) {
                mkdir($dirUsers);
            }
            $dirAnk = H . '/uploads/users/' . $user->id . '/';
            if (!is_dir($dirAnk)) {
                mkdir($dirAnk);
            }
            $path = H . '/uploads/users/' . $user->id . '/photo/';
            if (!is_dir($path)) {
                mkdir($path);
            }

            if (move_uploaded_file($_FILES['file']['tmp_name'], $path . $uploadfile)) {

                $params = array(
                    "id_user" => $user->id,
                    "avatar" => 1
                );
                $avatar = $db->select("users__photo", $params);
                if ($avatar) {
                    @unlink($path . $avatar->screen);
                    $db->delete('users__photo', $avatar->id);
                }
                $data = array(
                    'id_user' => $user->id,
                    'screen' => $uploadfile,
                    'avatar' => 1
                );
                $result = $db->insert('users__photo', $data);
                @chmod($path . $uploadfile, 0777);
                echo json_encode(array('result' => 'success', 'src' => '/uploads/users/' . $user->id . '/photo/' . $uploadfile, 'id' => $result));

            }
        } else {
            $err = 'Формат .' . $ras . ' не подойдет';
            echo json_encode(array('result' => 'error', 'msg' => $err));
        }

    } else echo json_encode(array('result' => 'error', 'msg' => 'Данные не поступили'));

} else   echo json_encode(array('result' => 'error', 'msg' => 'Вы не авторизованы'));
