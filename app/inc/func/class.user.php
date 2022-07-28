<?php
	function get_user($ID = 0)
	{
		global $db;
		$ID = (int)$ID; //Определяем ID
		$db->where ("id", $ID);
		$user = $db->ObjectBuilder()->getOne("users");
		return $user;
	}
?>