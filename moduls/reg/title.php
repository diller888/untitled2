<?php

$moduls = $db->selectOne("moduls", "link", $_GET['act']);

    $title = (!empty($moduls->title) ? $moduls->title : $moduls->name);

