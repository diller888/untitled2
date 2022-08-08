<?php

echo '<div class="debug">';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$reqs = get_included_files();
echo '<div class="debug__title">Скрипты</div>';
foreach ($reqs as $debug) {
    $pos = strpos($debug, 'moduls');
    if ($pos !== false)echo '<div class="debug__get">' . $debug . '</div>';
}
if (isset($_GET)) {
    echo '<div class="debug__title">$_GET параметры</div>';
    foreach ($_GET as $debugkey => $debugValue) {
        echo '<div class="debug__get">[' . $debugkey . '] => ' . $debugValue . '</div>';
    }
}
echo '<div class="debug__title">PATH</div>';
echo '<div class="debug__get">' . $_SERVER['DOCUMENT_ROOT'] .$_SERVER['REQUEST_URI'].'</div>';

if (isset($_SESSION)) {
    echo '<div class="debug__title">$_SESSION данные</div>';
    foreach ($_SESSION as $debugkey => $debugValue) {
        if (is_array($debugValue)){
            foreach ($debugValue as $debugkeys => $debugValues) {
                echo '<div class="debug__get">[' . $debugkey . '][' . $debugkeys . '] => ' . $debugValues . '</div>';
            }
        } else echo '<div class="debug__get">[' . $debugkey . '] => ' . $debugValue . '</div>';
    }
}
if (isset($_COOKIE)) {
    echo '<div class="debug__title">$_COOKIE данные</div>';
    foreach ($_COOKIE as $debugkey => $debugValue) {
        if (is_array($debugValue)){
            foreach ($debugValue as $debugkeys => $debugValues) {
                echo '<div class="debug__get">[' . $debugkey . '][' . $debugkeys . '] => ' . $debugValues . '</div>';
            }
        } else echo '<div class="debug__get">[' . $debugkey . '] => ' . $debugValue . '</div>';
    }
}
echo '</div>';