<?php
if (isset($_GET['id'])) {
    $ID = $_GET['id'];
    if ($ID == 400) {
        $title = 'Forbidden';
    } elseif ($ID == 401) {
        $title = 'Страница не существует';
    } elseif ($ID == 403) {
        $title = 'Forbidden';
    } elseif ($ID == 404) {
        $title = 'Страница не существует';
    } elseif ($ID == 405) {
        $title = 'Method Not Allowed';
    } elseif ($ID == 408) {
        $title = 'Request Timed Out';
    } elseif ($ID == 414) {
        $title = 'Request URI Too Long';
    } elseif ($ID == 500) {
        $title = 'Internal Server Error';
    } elseif ($ID == 501) {
        $title = 'Not Implemented';
    } elseif ($ID == 502) {
        $title = 'Bad Gateway';
    } elseif ($ID == 503) {
        $title = 'Service Unavailable';
    } elseif ($ID == 504) {
        $title = 'Gateway Timeout';
    } else {
        $title = 'Страница не существует';
    }
} else {
    $title = 'Страница не существует';
}