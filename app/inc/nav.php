<?php

if (file_exists(H . 'tpl/' . (isset($set->tpl) ? $set->tpl : 'default') . '/inc/nav.php')) {//подгрузим навигацию из шаблона

    require_once H . 'tpl/' . (isset($set->tpl) ? $set->tpl : 'default') . '/inc/nav.php';

} else {
    ?>
    <nav class="navbar">
        <div class="container">

        </div>
    </nav>
    <?php
}
    
    