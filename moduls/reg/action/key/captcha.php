<?php
if (!empty($_POST['chislo'])) {
    $chislo = intval($_POST['chislo']);
    if (strlen($chislo) != 5) $err = 'Не указано проверочное число';
    if ($chislo != $sess->captcha) $err = 'Не верно указано проверочное число';
    $sess->chislo = $chislo;
} else $err = 'Вы не ввели проверочное число';