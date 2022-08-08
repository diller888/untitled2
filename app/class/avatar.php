<?
/**
 * Класс вывода фото пользователя
 */

function avatar($ID, $class = 'avatar-images')
{

    global $db;
    $params = array(
        "id_user" => $ID,
        "avatar" => 1
    );
    $avatar = $db->select("users__photo", $params);
    if ($avatar) {

        if (is_file(H . 'uploads/users/' . $ID . '/photo/' . $avatar->screen)) {
            return '<div class="' . $class . '"><img src="/uploads/users/' . $ID . '/photo/' . $avatar->screen . '" alt="Avatar"  /></div>';
        } else return '<div class="' . $class . '"><i class="icon-avatar"></i><span>Нет фото</span></div>';

    } else return '<div class="' . $class . '"><i class="icon-avatar"></i><span>Нет фото</span></div>';

}
