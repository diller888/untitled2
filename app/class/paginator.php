<?
// Выдает текущую страницу
function page($k_page=1)
{ 
	$page = 1;

	if (isset($_GET['page']))
	{
		if ($_GET['page'] == 'end')
			$page = intval($k_page);
			
		elseif(is_numeric($_GET['page'])) 
		$page = intval($_GET['page']);
	}

	if ($page < 1)$page = 1;

	if ($page > $k_page)
		$page = $k_page;
		
	return $page;
}

// Высчитывает количество страниц
function k_page($k_post = 0, $k_p_str = 10)
{ 
	if ($k_post != 0) 
	{
		$v_pages = ceil($k_post / $k_p_str);
		return $v_pages;
	}

	else return 1;
}

// Вывод номеров страниц (только на первый взгляд кажется сложно ;))
function str($link = '?', $k_page = 1,$page = 1)
{ 
	if ($page < 1)
		$page = 1;

echo '<div class="text-center">';
	echo '<ul class="pagination pagination-large">';

	if ($page != 1)
		echo '<li><a href="' . $link . 'page=1" class="dsc" aria-label="Previous" title="Первая страница"><span aria-hidden="true">&laquo;</span></a></li>';

	if ($page != 1)
		echo '<li><a href="' . $link . 'page=1" class="dsc" title="Страница №1">1</a></li>';
	else 
		echo '<li class="active"><a href="#">1</a></li>';

	for ($ot = -3; $ot <= 3; $ot++)
	{
		if ($page + $ot > 1 && $page + $ot < $k_page)
		{
			if ($ot == -3 && $page + $ot > 2)
				echo '<li><a href="#"> ..</a></li>';

			if ($ot != 0)
				echo '<li><a href="' . $link . 'page=' . ($page + $ot) . '" class="dsc" title="Страница №' . ($page + $ot) . '">' . ($page + $ot) . '</a></li>';
			else 
				echo ' <li class="active"><a>' . ($page + $ot) . '</a></li>';

			if ($ot == 3 && $page + $ot < $k_page - 1)
				echo '<li><a href="#"> ..</a></li>';
		}
	}

	if ($page != $k_page)
		echo ' <li><a href="' . $link . 'page=end" class="dsc" title="Страница №' . $k_page . '">' . $k_page . '</a></li>';
	
	elseif ($k_page > 1)
		echo ' <li class="active"><a href="#">' . $k_page . '</a></li>';
		
	if ($page != $k_page)
		echo ' <li><a href="' . $link . 'page=end" class="dsc" title="Последняя страница"><span aria-hidden="true">&raquo;</span></a></li>';

	echo '</ul>';
	echo '</div>';
}



// Вывод номеров страниц (только на первый взгляд кажется сложно ;))
function p_str($link = '?', $k_page = 1,$page = 1)
{ 
	if ($page < 1)
		$page = 1;

echo '<nav class="d-inline-block">';
	echo '<ul class="pagination">';

	if ($page != 1)
		echo '<li class="page-item"><a href="' . $link . 'page=1" class="page-link" aria-label="Previous" title="Первая страница"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';

	if ($page != 1)
		echo '<li class="page-item"><a href="' . $link . 'page=1" class="page-link" title="Страница №1">1</a></li>';
	else 
		echo '<li class="page-item active"><a class="page-link" href="#">1</a></li>';

	for ($ot = -3; $ot <= 3; $ot++)
	{
		if ($page + $ot > 1 && $page + $ot < $k_page)
		{
			if ($ot == -3 && $page + $ot > 2)
				echo '<li class="page-item"><a href="#" class="page-link"> ..</a></li>';

			if ($ot != 0)
				echo '<li class="page-item"><a href="' . $link . 'page=' . ($page + $ot) . '" class="page-link" title="Страница №' . ($page + $ot) . '">' . ($page + $ot) . '</a></li>';
			else 
				echo ' <li class="page-item active"><a class="page-link">' . ($page + $ot) . '</a></li>';

			if ($ot == 3 && $page + $ot < $k_page - 1)
				echo '<li class="page-item"><a href="#" class="page-link"> ..</a></li>';
		}
	}

	if ($page != $k_page)
		echo ' <li class="page-item"><a href="' . $link . 'page=end" class="page-link" title="Страница №' . $k_page . '">' . $k_page . '</a></li>';
	
	elseif ($k_page > 1)
		echo ' <li class="page-item active"><a href="#">' . $k_page . '</a></li>';
		
	if ($page != $k_page)
		echo ' <li class="page-item"><a href="' . $link . 'page=end" class="page-link" title="Последняя страница"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';

	echo '</ul>';
echo '</nav>';
}
?>