<?php
function online($user = NULL)
{
	global $db, $time;
	
	if (isset($user))
	{
	    $result = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `users` WHERE `id` = '$user' AND `date_last` > '" . (time()-600) . "'"));
	    $db->where ("id", $user);
	    $db->where ("date_last > " . (time()-600));
	    $result = $db->getOne("users", "count(*)");
		if ($result > 0)
		{
			$online = '<span class="online">online</span>';
		}
		else
		{
			$db->where ("id", $user);
			$ank = $db->ObjectBuilder()->getOne("users");
			$online = '<span class="offline">'.vremja($ank->date_last).'</span>';
			
		}
	}
	return $online;
}

?>