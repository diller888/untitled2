<?

//перенос строк
function br($msg,$br='<br />'){return preg_replace("#((<br( ?/?)>)|\n|\r)+#i",$br, $msg);}

// функция обрабатывает текстовые строки перед выводом в браузер
// настоятельно не рекомундуется тут что-либо менять
function output_text($str,$br=1,$html=1,$links=1)
{


	if ($html)$str=htmlentities($str, ENT_QUOTES, 'UTF-8'); // преобразуем все к нормальному перевариванию браузером

	if ($br)
	{
		$str=br($str); // переносы строк
	}
	
	if ($links)$str=links($str); // обработка ссылок

	return stripslashes($str); // возвращаем обработанную строку
}

function rez_text( $text, $maxwords = 15, $maxchar = 100 ){
	$sep=' ';

	$sep2=' &raquo;';

	$words = explode($sep,$text);

	$char = iconv_strlen($text,'utf-8');

	if (count($words) > $maxwords){		$text = join($sep, array_slice($words, 0, $maxwords));
	}

	if ( $char > $maxchar ){
		$text = iconv_substr( $text, 0, $maxchar, 'utf-8' );

	}

	return $text;
}


?>