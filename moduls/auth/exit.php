<?php

$sess->destroy();

setcookie('id_user', '', time()+8640000, '/');

header('Location: /');
exit;