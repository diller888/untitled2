<div class="container">
    <div class="profile">
        <form class="form form-profile">
            <div class="form__title">Редактировать профиль</div>
            <div class="row">
                <div class="row__col-6">
                    <div class="form__group">
                        <label>Имя Фамилия <span class="form__action action--name"></span></label>
                        <input type="text" name="name" class="form__input form--name" value="<?= $user->name ?>"
                               placeholder="Ваше имя">
                    </div>
                </div>
                <div class="row__col-6">
                    <div class="form__group">
                        <label>Номер телефона <span class="form__action action--phone"></span></label>
                        <?php
                        if (strlen($user->phone)>4){
                            $phone = new phone_number($user->phone);
                            $tel = $phone->mobile();
                        }
                        ?>
                        <input type="text" name="phone" class="form__input form-tel" value="<?= ($tel ? $tel : null) ?>"
                               placeholder="+7 (900) 000 00 00">
                    </div>
                </div>
                <div class="row__col-6">
                    <div class="form__group">
                        <label>Адрес доставки</label>
                        <input type="text" name="address" class="form__input form--address" value="<?= $user->address ?>"
                               placeholder="Введите адрес">
                        <span class="show--address"></span>
                    </div>
                </div>
                <div class="row__col-6">
                    <div class="form__group">
                        <label>Email <span class="form__action action--email"></span></label>
                        <input type="text" name="email" class="form__input form--email" value="<?= $user->email ?>"
                               placeholder="Введите email">
                    </div>
                </div>
                <div class="row__col-6">
                    <div class="form__group">
                        <label>Пароль <span class="form__action action--pass"></span></label>
                        <input type="text" name="password" class="form__input form__password" value="<?= $user->password ?>"
                               placeholder="Ваш пароль">
                        <span class="form__showpass">
                            <i class="icon-eye"></i>
                        </span>
                    </div>
                </div>
                <div class="row__col-12">
                    <div class="form__button">
                        <button type="button" class="form__submit">Сохранить</button>
                        <div class="form__result"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>