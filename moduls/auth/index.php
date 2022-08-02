<div class="auth">
    <div class="auth__list">
        <div class="auth__photo">
            <img src="/uploads/tmp/auth.webp" alt="Авторизация">
        </div>
        <div class="auth__form">
            <a href="/" class="auth__home link"><i class="icon-left"></i> На главную</a>
            <form class="form form-auth">
                <h1 class="auth__title">Авторизация</h1>
                <div class="auth__form-group">
                    <label>Логин</label>
                    <input class="auth__form-input login-input" type="text" name="login" maxlength="64"
                           placeholder="Логин, email или номер телефона" required>
                    <span class="auth__form-group-error login-error"></span>
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
                            <button type="submit" class="auth__form-submit" disabled>Войти</button>
                        </div>
                    </div>
                    <div class="auth__row-col">
                        <div class="auth-recovery">
                            <a href="/auth/recovery" class="link">Напомнить пароль</a>
                        </div>
                    </div>
                </div>
                <div class="auth__footer">
                    <a href="/reg" class="auth__reglink link">Регистрация</a>
                </div>
            </form>
        </div>
    </div>
</div>