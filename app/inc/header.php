<?php
$pic_head = isset($set->photo) ? $set->photo : null;
$openGraph = isset($head_photo) ? $head_photo : $pic_head;
$set->domen = isset($set->domen) ? $set->domen : $_SERVER['SERVER_NAME'];
$openGraph = 'https://' . $set->domen . '/' . $openGraph;
if (isset($set_key)) $set->set_key = $set_key;
if (isset($set_meta)) $set->set_meta = $set_meta;
?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="ru" prefix="og: http://ogp.me/ns#">
    <head>
        <meta charset="utf-8">
        <title itemprop="headline"><?= $title ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="format-detection" content="telephone=YES">
        <meta name="og:title" content="<?= $title ?>">
        <meta name="og:description" content="<?= isset($set->set_meta) ? $set->set_meta : null ?>">
        <meta name="og:url" content="https://www.<?= $set->domen ?><?= $_SERVER['REQUEST_URI'] ?>">
        <meta property="og:image" content="<?= $openGraph ?>">
        <meta name="og:site_name" content="<?= isset($set->company) ? $set->company : null ?>">
        <meta name="og:locale" content="ru_RU">
        <meta name="og:type" content="website">
        <?php
        if (file_exists(H . 'tpl/' . (isset($set->tpl) ? $set->tpl : 'default') . '/css/style.css')){
            $loadCss = opendir(H.'tpl/' . (isset($set->tpl) ? $set->tpl : 'default') . '/css/');
            while ($filecss = readdir($loadCss))
            {
                if (preg_match('#\.css$#i', $filecss))echo "\t\t<link rel='stylesheet' href='/tpl/default/css/" . $filecss . "?d=".(microtime(true))."' media='screen and (max-width: 2500px)'>\n";
            }
        }
        if (isset($set->set_key)) echo "\t\t<meta name=\"keywords\" itemprop=\"keywords\" content=\"" . $set->set_key . "\" />\n";
        if (isset($set->set_meta)) echo "\t\t<meta name=\"description\" itemprop=\"description\" content=\"" . $set->set_meta . "\" />\n";
        ?>
    </head>
    <body>
    