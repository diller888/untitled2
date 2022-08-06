<div class="auth">
    <div class="auth__list">
        <div class="auth__photo">
            <img src="/uploads/tmp/reg.webp" alt="Регистрация">
        </div>
        <div class="auth__form">
            <a href="/" class="auth__home link"><i class="icon-left"></i> На главную</a>
            <form class="form form-auth" method="post" action="/moduls/reg/action/login.php">
                <h1 class="auth__title">Регистрация</h1>
                <div class="auth__form-group">
                    <label>Логин</label>
                    <input class="auth__form-input login-input" type="text" name="login" maxlength="64"
                           placeholder="Логин" required>
                    <span class="auth__form-group-error login-error"></span>
                </div>
                <div class="auth__form-group">
                    <label>Email</label>
                    <input class="auth__form-input email-input" type="text" name="email" maxlength="64"
                           placeholder="name@<?=$_SERVER['SERVER_NAME']?>" required>
                    <span class="auth__form-group-error email-error"></span>
                </div>
                <div class="auth__form-group">
                    <label>Номер телефона</label>
                    <input class="auth__form-input phone-input" type="text" name="phone"
                           placeholder="+7 (900) 000 00 00" required>
                    <span class="auth__form-group-error phone-error"></span>
                </div>
                <div class="auth__form-group">
                    <label>Пароль</label>
                    <input class="auth__form-input pass-input" type="text" class="pass-field" name="password"
                           maxlength="32" placeholder="***********" required>
                    <span class="auth__form-group-error password-error"></span>
                    <div class="pass-show">
                        <i class="icon-eye"></i>
                    </div>
                </div>
                <div class="auth__form-group">
                    <label>Введите символы</label>
                    <div class="auth__row">
                        <div class="auth__row-col">
                            <picture>
                                <img src='/app/inc/func/captcha.php' width='167' height='50' alt='Проверочное число'/>
                            </picture>
                        </div>
                        <div class="auth__row-col">
                            <input class="auth__form-input chislo-input" type="text" name="chislo" maxlength="5"
                                   placeholder="Captcha" required>
                            <span class="auth__form-group-error chislo-error"></span>
                        </div>
                    </div>
                </div>
                <div class="auth__row">
                    <div class="auth__row-col">
                        <div class="auth__form-button">
                            <button type="submit" class="auth__form-submit" disabled>Регистрация</button>
                        </div>
                    </div>
                    <div class="auth__row-col">
                        <div class="auth-recovery">
                            <a href="/auth" class="link">Войти</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>