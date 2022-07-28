<?php

if (isset($_GET['id'])) {
    $ID = $_GET['id'];
    if ($ID == 404) {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        header("Content-type: text/html", NULL, '404');
        echo '<div class="not-found">';
        echo '<picture>';
        echo '<img src="/uploads/images/not_found.webp" alt="not-found">';
        echo '</picture>';
        echo '<div class="not-found__panel">';
        if (isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
            echo '<a href="' . $previous . '">Назад</a>';
        }
        echo '<a href="/">На главную</a>';
        echo '</div>';
        echo '</div>';
    } elseif ($ID == 500) {
        echo 'Internal Server Error';
    } else {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        header("Content-type: text/html", NULL, '404');
        echo '404 Not Found';
    }
} else {
    if ($isAjax == FALSE) {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        header("Content-type: text/html", NULL, '404');
    }
    echo '<div class="not-found">';
    echo '<picture>';
    echo '<img src="/uploads/images/not_found.webp" alt="not-found">';
    echo '</picture>';
    echo '<div class="not-found__panel">';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
        echo '<a href="' . $previous . '">Назад</a>';
    }
    echo '<a href="/">На главную</a>';
    echo '</div>';
    echo '</div>';
}