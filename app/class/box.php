<?

/**
 * Класс вывода и отображения редактируемого текста
 */
function box($div, $ID, $box, $type = 'div')
{

    global $db;
    global $user;

    $block = $type;

    $content = $db->selectOne("content", "id", $ID);

    if (isset($user->id) && $user->level > 0) {
        return '<' . $block . ' class="' . $div . ' edit" data-id="' . $ID . '" data-box="' . $box . '" contenteditable="true" role="textbox" aria-multiline="true">' . $content->$box . '</' . $block . '>';
    } else {
        return '<' . $block . ' class="' . $div . '">' . $content->$box . '</' . $block . '>';
    }

}

/**
 * Класс вывода и отображения иконки
 */
function icons($ID, $mod, $id_mod, $type = 'i')
{

    global $db;
    global $user;

    $block = $type;

    $icons = $db->selectOne("icons", "id", $ID);

    if (isset($user->id) && $user->level > 0) {
        return '<span class="set-icons ikon-' . $ID . '"><' . $block . ' class="icon-' . $icons->name . '"></' . $block . '><span class="sets-icons icon-cog1" data-id="' . $ID . '" data-mod="' . $mod . '" data-pid="' . $id_mod . '"></span></span>';
    } else {
        return '<' . $block . ' class="icon-' . $icons->name . '"></' . $block . '>';
    }

}

/**
 * Класс вывода и отображения редактируемого изображения
 */
function boxscreen($div, $ID)
{

    global $db;
    global $user;

    $img = $db->selectOne("images", "id", $ID);
    if ($img->id) {
        $caps = (strlen($img->caption) > 2 ? $img->caption : $img->name);
        $image = (strlen($img->screen) > 2 ? 'image/' . $img->screen : 'images/no-photo.png');
        if (isset($user->id) && $user->level > 0) {
            return '<div class="' . $div . ' boxscreen" data-id="' . $ID . '"><picture class="image-' . $ID . '">' . (strlen($img->link) > 0 ? '<a href="' . $img->link . '">' : null) . '<img src="/uploads/' . $image . '" alt="' . $caps . '">' . (strlen($img->link) > 0 ? '</a>' : null) . '</picture><div class="boxscreen__item" data-id="' . $ID . '"></div></div>';
        } else {
            return '<div class="' . $div . '"><picture><img src="/uploads/image/' . $img->screen . '" alt="' . $caps . '"></picture></div>';
        }
    } else {
        if (isset($user->id) && $user->level > 0) {
            return '<div class="' . $div . ' boxscreen" data-id="' . $ID . '"><picture class="image-' . $ID . '"><img src="/uploads/images/no-photo.png" alt="Нет фото"></picture><div class="boxscreen__item" data-id="' . $ID . '"></div></div>';
        } else {
            return '<div class="' . $div . '"><picture><img src="/uploads/images/no-photo.png" alt="Нет фото"></picture></div>';
        }
    }

}

/**
 * Класс вывода и отображения редактируемой ссылки
 */
function boxlink($div, $ID, $target = null, $icons = null)
{

    global $db;
    global $user;

    $icon = $icons;
    if (strlen($icon) > 2) {
        $icon = '<i class="' . $icon . '"></i>';
    }

    $link = $db->selectOne("link", "id", $ID);
    if (isset($user->id) && $user->level > 0) {
        return '<span class="edit-link link-' . $ID . '"><a href="' . $link->link . '" class="' . $div . '"' . ($target == 1 ? ' target="_blank"' : null) . '>' . $icon . ' ' . $link->title . '</a><link class="linkens icon-link" data-id="' . $ID . '" data-box="' . $div . '"></link></span>';
    } else {
        return '<a href="' . $link->link . '" class="' . $div . '"' . ($target == 1 ? ' target="_blank"' : null) . '>' . $icon . ' ' . $link->title . '</a>';
    }

}

/**
 * Класс вывода и отображения редактируемого фонового изображения
 */
function boxbg($div, $ID)
{

    global $db;
    global $user;

    $img = $db->selectOne("images", "id", $ID);
    $caps = (strlen($img->caption) > 2 ? $img->caption : $img->name);
    if (isset($user->id) && $user->level > 0) {
        return '<div class="' . $div . ' boxbg" data-id="' . $ID . '"><picture class="image-' . $ID . '">' . (strlen($img->link) > 0 ? '<a href="' . $img->link . '">' : null) . '<img src="/uploads/image/' . $img->screen . '" alt="' . $caps . '">' . (strlen($img->link) > 0 ? '</a>' : null) . '</picture><div class="boxscreen__item" data-id="' . $ID . '"></div></div>';
    } else {
        return '<div class="' . $div . '"><picture><img src="/uploads/image/' . $img->screen . '" alt="' . $caps . '"></picture></div>';
    }

}