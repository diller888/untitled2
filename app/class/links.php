<?php



function links($msg)
{
    
    $pos = strpos($msg, 'https://');
    
    if ($pos === true) {
        
        $msg = $msg;
        
    } else {
        
        $row = strpos($msg, 'http://');
        
        if ($row === false) {
            
            $video = strpos($msg, 'youtube');
            
            if ($video === false) {
                $img = strpos($msg, 'src');
                if ($img === false) {
                $msg = preg_replace('(https://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' data-type='link' target='_blank'>ссылка</a>", $msg);
                }
                
            } else {
                
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $msg, $match);
                $youtube_id = $match[1];
                $msg = preg_replace('(https://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<div class='c-video'><iframe src='https://www.youtube.com/embed/".$youtube_id."' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></div>", $msg);
                
            }
            
        } else {
            
                $img = strpos($msg, 'src');
                if ($img === false) {
            $msg = preg_replace('(http://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' data-type='link' target='_blank'>ссылка</a>", $msg);
                }
            
        }
    }
    
    return $msg;
    
}

function link2($msg)
{
    
    $pos = strpos($msg, 'https://');
    
    if ($pos === true) {
        
        $msg = $msg;
        
    } else {
        
        $row = strpos($msg, 'http://');
        
        if ($row === false) {
            
            $video = strpos($msg, 'youtube');
            
            if ($video === false) {
                
                $msg = preg_replace('(https://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' data-type='link' target='_blank'>ссылка</a>", $msg);
                
                
            } else {
                
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $msg, $match);
                $youtube_id = $match[1];
                $msg = preg_replace('(https://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', " ", $msg);
                
            }
            
        } else {
            
            $msg = preg_replace('(http://[\w+?\.\w+]+[a-zA-Z0-9\~\!\@\#\$\%\^\&amp;\*\(\)_\-\=\+\\\/\?\:\;\'\.\/]+[\.]*[a-zA-Z0-9\/]+)', "<a href='$0' data-type='link' target='_blank'>ссылка</a>", $msg);
            
        }
    }
    
    return $msg;
    
}


function links_title($url)
{
	
	$page = @file_get_contents($url);
    $title = preg_match("|<title>([^<]+)</title>|is", $page, $matches) ? $matches[1] : '';
    
    if (mb_check_encoding($title, 'Windows-1251') && !mb_check_encoding($title, 'UTF-8')){
        $title = iconv("CP1251//IGNORE", "UTF-8", $title);
    }
	
	return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
	
}

?>