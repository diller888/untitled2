<div class="container">
    <div class="profile">
        <div class="row">
            <div class="row__col-4">
                <div class="profile__photo">
                    <?php
                    $params = array(
                        "id_user" => $user->id,
                        "avatar" => 1
                    );
                    $avatar = $db->select("users__photo", $params);
                    echo avatar($user->id, 'profile__images');
                        echo '<label for="avatar" class="profile__photo-edit">';
                        echo '<input type="file" id="avatar" name="file">';
                        echo '<span class="profile__images-text">' . (!$avatar ? 'Загрузить' : 'Изменить') . ' фото</span>';
                        echo '</label>';
                        echo '<div class="profile__photo-delete' . (!$avatar ? ' hidden' : null) . '"><i class="icon-close"></i></div>';
                        echo '<input type="hidden" class="ava" value="' . ($avatar ? $avatar->id : null) . '">';

                    ?>
                </div>
                <div class="profile__box">
                    <div class="profile__title">
                        <?php
                        echo '<h1>' . fullname($user->id) . '</h1>';
                        echo '<a href="/profile/' . $user->id . '/setting" class="profile__edit link"><i class="icon-cog"></i></a>';
                        ?>
                    </div>
                    <?php
                    echo '<div class="profile__info"><a href="/exit">Выйти</a></div>';
                    ?>
                </div>
            </div>
            <div class="row__col-8">
                <div class="profile__container">
                    <div class="tab">
                        <ul class="tab__list">
                            <li class="tab__item active" data-tabs-path="main">Мои заказы</li>
                            <li class="tab__item" data-tabs-path="row">История платежей</li>
                        </ul>
                    </div>
                    <div class="tab__content active" data-tabs-target="main">
                        <h2>Заказы</h2>
                        <div class="no-post">Пусто</div>
                    </div>
                    <div class="tab__content" data-tabs-target="row">
                        <h2>История платежей</h2>
                        <div class="no-post">Пусто</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='UploadFile close-div'>
        <div class="UploadTotal"></div>
        <div class="UploadLoader"></div>
        <div class="UploadHr"></div>
        <div class="UploadProgress"></div>
    </div>
</div>