<?php
echo "<div class='loader'><i class='icon-spinner-third'></i><span></span></div>\n";
echo "<div class='action'>\n";

if (isset($_GET['cid']) && strlen($_GET['cid']) > 0) {
    $fileName = 'column_';
} elseif (isset($_GET['item']) && strlen($_GET['item']) > 0) {
    $fileName = 'item_';
} elseif (isset($_GET['list']) && strlen($_GET['list']) > 0) {
    $fileName = 'list_';
} elseif (isset($_GET['id']) && strlen($_GET['id']) > 0) {
    $fileName = 'row_';
} else {
    $fileName = '';
}

if (file_exists(TPL . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/js/' . $fileName . 'main.js')) {
    echo "		<script type='module' src='" . PATH . (isset($_GET['act']) ? $_GET['act'] : 'main') . "/js/" . $fileName . "main.js?d=" . (microtime(true)) . "' defer></script>
";
} elseif (file_exists(M . (isset($_GET['act']) ? $_GET['act'] : 'main') . '/js/' . $fileName . 'main.js')) {
    echo "		<script type='module' src='/moduls/" . (isset($_GET['act']) ? $_GET['act'] : 'main') . "/js/" . $fileName . "main.js?d=" . (microtime(true)) . "' defer></script>
";
}
echo "</div>\n";
if (file_exists(H . 'app/plugins/js/main.js')) {
    $loadJs = opendir(H . 'app/plugins/js/');
    while ($filejs = readdir($loadJs)) {
        if (preg_match('#\.js$#i', $filejs)) echo "\t\t<script type='module' src='/app/plugins/js/" . $filejs . "?d=" . (microtime(true)) . "' defer></script>\n";
    }
}
?>

</body>
</html>