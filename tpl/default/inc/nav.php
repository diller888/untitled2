<navbar class="navbar">
    <div class="container">
        <div class="navbar__list">
            <div class="navbar__logo">
                <a href="/">
                    <picture>
                        <img src="/uploads/images/logo.png" alt="*">
                    </picture>
                </a>
            </div>
            <div class="navbar__search">
                <form class="search">
                    <div class="search__group">
                        <input type="text" name="search" class="search__input" placeholder="Я ищу">
                        <button type="button" class="search__submit">
                            <span class="icon-search"></span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="navbar__contact">
                <?php
                if (strlen($set->phone)>4){
                    $phone = new phone_number($set->phone);
                    $tel = $phone->mobile();
                    $tel_link = $set->phone;
                } elseif (strlen($set->tel)>4){
                    $phone = new phone_number($set->tel);
                    $tel = $phone->city();
                    $tel_link = $set->tel;
                } else {
                    $phone = new phone_number('+79829669819');
                    $tel = $phone->mobile();
                    $tel_link = '79829669819';
                }
                echo '<div class="navbar__contact-text">'.$tel.'</div>';
                echo '<div class="navbar__contact-time">Пн-Пт: 08-00-20:00</div>';
                echo '<div class="navbar__social">';
                    if (isset($set->vk) && strlen($set->vk)>2)echo '<a href="'.$set->vk.'" class="navbar__social-vk" target="_blank"><i class="icon-vk2"></i></a>';
                    if (isset($set->instagram) && strlen($set->instagram)>2)echo '<a href="'.$set->instagram.'" class="social__instagram" target="_blank"><i class="icon-instagram"></i></a>';
                    if (isset($set->ok) && strlen($set->ok)>2)echo '<a href="'.$set->ok.'" class="navbar__social-ok" target="_blank"><i class="icon-ok"></i></a>';
                    if (isset($set->telegram) && strlen($set->telegram)>2)echo '<a href="'.$set->telegram.'" class="navbar__social-telegram" target="_blank"><i class="icon-telegram"></i></a>';
                    if (isset($set->facebook) && strlen($set->facebook)>2)echo '<a href="'.$set->facebook.'" class="navbar__social-facebook" target="_blank"><i class="icon-facebook"></i></a>';
                    if (isset($set->twitter) && strlen($set->twitter)>2)echo '<a href="'.$set->twitter.'" class="navbar__social-twitter" target="_blank"><i class="icon-twitter"></i></a>';
                    if (isset($set->youtube) && strlen($set->youtube)>2)echo '<a href="'.$set->youtube.'" class="navbar__social-youtube" target="_blank"><i class="icon-youtube"></i></a>';
                    if (isset($set->viber) && strlen($set->viber)>2)echo '<a href="viber://chat?number='.$set->viber.'" class="navbar__social-viber" target="_blank"><i class="icon-viber"></i></a>';
                    if (isset($set->whatsapp) && strlen($set->whatsapp)>2)echo '<a href="https://wa.me/'.$set->whatsapp.'" class="navbar__social-whatsapp" target="_blank"><i class="icon-whatsapp"></i></a>';
                    echo '<a class="navbar__contact-phone" href="tel:+'.$tel_link.'"><i class="icon-phone"></i></a>';
                echo '</div>';

                ?>
            </div>
            <div class="navbar__panel">
                <div class="navbar__panel-list">
                    <a href="/" class="navbar__panel-link link link--border">
                        <i class="icon-heart"></i>
                    </a>
                    <a href="<?= (isset($user) ? '/id'.$user['id'] : '/auth')?>" class="navbar__panel-link link">
                        <i class="icon-user"></i>
                    </a>
                    <a href="/" class="navbar__cart link">
                        <i class="icon-bag-shop"></i>
                        <span class="navbar__cart-count">0</span>
                    </a>
                </div>
            </div>
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="navbar__menu">
            <div class="menu">
                <div class="menu__list">
                    <div class="menu__item">
                        <a href="/catalog" class="menu__link">Каталог</a>
                    </div>
                    <div class="menu__item">
                        <a href="/customer" class="menu__link">Для клиента</a>
                    </div>
                    <div class="menu__item">
                        <a href="/about" class="menu__link">О нас</a>
                    </div>
                    <div class="menu__item">
                        <a href="/why" class="menu__link">Как заказать?</a>
                    </div>
                    <div class="menu__item">
                        <a href="/contact" class="menu__link">Контакты</a>
                    </div>
                    <div class="menu__item">
                        <a href="/delivery" class="menu__link">Доставка</a>
                    </div>
                    <div class="menu__item">
                        <a href="/rules" class="menu__link">Правила ухода</a>
                    </div>
                    <div class="menu__item">
                        <a href="/rebiews" class="menu__link">Отзывы</a>
                    </div>
                    <div class="menu__item">
                        <a href="/blog" class="menu__link">Блог</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</navbar>