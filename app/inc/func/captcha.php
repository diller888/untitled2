<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');

require 'session.php';

function MultiWave($img)
{

    $width=imagesx($img);
    $height=imagesy($img);

    $img2=imagecreatetruecolor($width, $height);

    $rand1 = mt_rand(700000, 1000000) / 15000000;
    $rand2 = mt_rand(700000, 1000000) / 15000000;
    $rand3 = mt_rand(700000, 1000000) / 15000000;
    $rand4 = mt_rand(700000, 1000000) / 15000000;
// фазы
    $rand5 = mt_rand(0, 3141592) / 1000000;
    $rand6 = mt_rand(0, 3141592) / 1000000;
    $rand7 = mt_rand(0, 3141592) / 1000000;
    $rand8 = mt_rand(0, 3141592) / 1000000;
// амплитуды
    $rand9 = mt_rand(400, 600) / 100;
    $rand10 = mt_rand(400, 600) / 100;

    for($x = 0; $x < $width; $x++){
        for($y = 0; $y < $height; $y++){
            // координаты пикселя-первообраза.
            $sx = $x + ( sin($x * $rand1 + $rand5) + sin($y * $rand3 + $rand6) ) * $rand9;
            $sy = $y + ( sin($x * $rand2 + $rand7) + sin($y * $rand4 + $rand8) ) * $rand10;

            // первообраз за пределами изображения
            if($sx < 0 || $sy < 0 || $sx >= $width - 1 || $sy >= $height - 1){
                $color = 255;
                $color_x = 255;
                $color_y = 255;
                $color_xy = 255;
            }else{ // цвета основного пикселя и его 3-х соседей для лучшего антиалиасинга
                $color = (imagecolorat($img, $sx, $sy) >> 16) & 0xFF;
                $color_x = (imagecolorat($img, $sx + 1, $sy) >> 16) & 0xFF;
                $color_y = (imagecolorat($img, $sx, $sy + 1) >> 16) & 0xFF;
                $color_xy = (imagecolorat($img, $sx + 1, $sy + 1) >> 16) & 0xFF;
            }



            // сглаживаем только точки, цвета соседей которых отличается
            if($color == $color_x && $color == $color_y && $color == $color_xy){
                $newcolor=$color;
            }else{
                $frsx = $sx - floor($sx); //отклонение координат первообраза от целого
                $frsy = $sy - floor($sy);
                $frsx1 = 1 - $frsx;
                $frsy1 = 1 - $frsy;

                // вычисление цвета нового пикселя как пропорции от цвета основного пикселя и его соседей
                $newcolor = floor( $color    * $frsx1 * $frsy1 +
                    $color_x  * $frsx  * $frsy1 +
                    $color_y  * $frsx1 * $frsy  +
                    $color_xy * $frsx  * $frsy );
            }
            imagesetpixel($img2, $x, $y, imagecolorallocate($img2, $newcolor, $newcolor, $newcolor));
        }
    }

    return $img2;
}

$_SESSION['captcha'] = rand(10000,99999);

$img=imagecreatetruecolor(167, 50);

imagefill($img, 0, 0, imagecolorallocate ($img, 255, 255, 255));

imagettftext ($img, 16, 0, 30, 30, imagecolorallocate ($img, 0, 0, 0), H . 'app/plugins/css/fonts/AvertaRegular.ttf', $_SESSION['captcha']);
header("Content-type: image/jpeg");

$img=MultiWave($img);
imagejpeg($img,null,20);