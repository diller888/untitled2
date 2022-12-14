<?php

//Проверка прав доступа, таблица в бд users, users__access
/**
 * ПРИМЕР ИСПОЛЬЗОВАНИЯ
 * if (user_access('owner')){ Если права выполним скрипт }
 * if (!user_access('owner')){ Если нет прав выполним скрипт }
 * список прав находится в таблице базы данных all_accesses
 * if (user_access('тут права из таблицы', 'ID пользователя users, можно использовать null', 'тут можно передать адрес страницы куда переслать клиента если нет прав'))
 */
function user_access($access, $u_id = null, $exit = false)
{

    global $db;
    global $user;

    if (!isset($user->group_access) || $user->group_access == null) {
        if ($exit !== false) {
            header('Location: ' . $exit);
            exit;
        } else return false;
    }

    $params = array(
        "id_group" => $user->group_access,
        "id_access" => $access
    );
    $group_info = $db->results("users__access", $params);
    if ($exit !== false) {
        if ($group_info == 0) {
            header("Location: $exit");
            exit;
        }
    } else
        return ($group_info > 0 ? true : false);
}

?>