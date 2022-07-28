<?php
 
function filter_characters($str) {
	return implode('', array_filter(str_split($str), function($digit) {
	    return (is_numeric($digit));
    }));
}

function get_filesize($file)
{
    // ищем файл
    if(!file_exists($file)) return "Файл  не найден";
   // теперь определяем размер файла в несколько шагов
  $filesize = filesize($file);
   // Если размер больше 1 Кб
   if($filesize > 1024)
   {
       $filesize = ($filesize/1024);
       // Если размер файла больше Килобайта
       // то лучше отобразить его в Мегабайтах. Пересчитываем в Мб
       if($filesize > 1024)
       {
            $filesize = ($filesize/1024);
           // А уж если файл больше 1 Мегабайта, то проверяем
           // Не больше ли он 1 Гигабайта
           if($filesize > 1024)
           {
               $filesize = ($filesize/1024);
               $filesize = round($filesize, 1);
               return $filesize." ГБ";       
           }
           else
           {
               $filesize = round($filesize, 1);
               return $filesize." MБ";   
           }       
       }
       else
       {
           $filesize = round($filesize, 1);
           return $filesize." Кб";   
       }  
   }
   else
   {
       $filesize = round($filesize, 1);
       return $filesize." байт";   
   }
}



function percent($price, $percent) {
	$number_percent = $price / 100 * $percent;
	$x = $price - $number_percent;
	$str = round($x, 2);
	return $str;
}

function get_wes($wes)
{
    $str = $wes*1000;
    if($str > 1000)
    {
        return $str." кг"; 
    } else {
       return $str." гр";   
   }
}

function get_pwes($wes)
{
    if($wes >= 1000)
    {
        $str = $wes/1000;
        return $str." кг"; 
    } else {
       return $wes." гр";   
   }
}

function sumCost($str){
    if ($str==1){
        $text = 'Шт';
    } elseif ($str==2){
        $text = 'Метр';
    } elseif ($str==3){
        $text = 'Упаковка';
    } elseif ($str==4){
        $text = 'Набор';
    } elseif ($str==5){
        $text = 'Комплект';
    } else {
        $text = 'Мешок';
    }
    return $text;
}
?>