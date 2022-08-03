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
    if ($avatar->id) {
        if (is_file(H . 'uploads/users/' . $ID . '/avatar/' . $avatar->screen)) {
            return '<img class="' . $class . '" src="/uploads/users/' . $ID . '/avatar/' . $avatar->screen . '" alt="Avatar"  />';
        } else return '<img class="' . $class . '" src="/uploads/images/no_photo.png" alt="No Avatar" />';
    } else {
        return '<img class="' . $class . '" src="/uploads/images/no_photo.png" alt="No Avatar" />';
    }

}

?>