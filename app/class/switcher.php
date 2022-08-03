<?php

function switcher($text, $reverse = false)
{

    $str[0] = array(
        "й", "ц", "у", "к", "е", "н", "г", "ш", "щ", "з", "х", "ъ",
        "ф", "ы", "в", "а", "п", "р", "о", "л", "д", "ж", "э",
        "я", "ч", "с", "м", "и", "т", "ь", "б", "ю"
    );
    $str[1] = array(
        "q", "w", "e", "r", "t", "y", "u", "i", "o", "p", "[", "]",
        "a", "s", "d", "f", "g", "h", "j", "k", "l", ";", "'",
        "z", "x", "c", "v", "b", "n", "m", ",", "."
    );
    $out = array();
    foreach ($str[0] as $i => $key) {
        $out[0][$i] = '#' . str_replace(array('.', ']', '['), array('\.', '\]', '\['), $str[$reverse ? 0 : 1][$i]) . '#ui';
        $out[1][$i] = $str[$reverse ? 1 : 0][$i];
    };
    return preg_replace($out[0], $out[1], $text);

}

?>