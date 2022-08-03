<?php
	function get_user($ID = 0)
	{
		global $db;
		$ID = (int)$ID; //Определяем ID
        $user = $db->selectOne("users", "id", $ID);
		return $user;
	}
?>