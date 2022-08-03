<?php
function online($user = NULL)
{
    global $db;

    if (isset($user)) {
        $params = "`id` = '$user' AND `date_last` > '" . (time() - 600);
        $q = dbquery('users', $params);
        $result = mysqli_num_rows($q);
        if ($result == 0) {
            $ank = $db->selectOne("users", "id", $user);
            $online = '<span class="offline">' . vremja($ank->date_last) . '</span>';
        } else
            $online = '<span class="online">online</span>';
        return $online;
    } else
        return false;
}

?>