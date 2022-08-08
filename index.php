<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
define("CORE", $_SERVER["DOCUMENT_ROOT"] . '/app/inc/');
require_once CORE . 'core.php';
require_once CORE . 'users.php';
require_once CORE . 'title.php';

if ($isAjax == FALSE) {
    require_once CORE . 'header.php';
    require_once CORE . 'nav.php';
    echo "<div class=\"content\">\n";
}
require_once CORE . 'mod.php';

if (isset($_GET['debug'])) {
    require_once CORE . 'debug.php';
}
if ($isAjax == FALSE) {
    echo "\n";
    echo "\t</div>\n";
    require_once CORE . 'footer.php';
}