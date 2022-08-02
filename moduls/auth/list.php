<div class="auth">
    <div class="auth__list">
        <div class="auth__photo">
            <img src="/uploads/tmp/recovery.webp" alt="Восстановить пароль">
        </div>
        <div class="auth__form">
            <a href="/" class="auth__home link"><i class="icon-left"></i> На главную</a>
            <form class="form form-recovery">
                <h1 class="auth__title">Напомнить пароль</h1>
                <div class="auth__form-group">
                    <label>Профиль</label>
                    <input class="auth__form-input recovery-input" type="text" name="login" maxlength="64"
                           placeholder="Логин, email или номер телефона" required>
                    <span class="auth__form-group-error recovery-error"></span>
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
                            <input class="auth__form-input captcha-input" type="text" name="chislo" maxlength="5"
                                   placeholder="Captcha" required>
                            <span class="auth__form-group-error captcha-error"></span>
                        </div>
                    </div>
                </div>
                <div class="auth__result"></div>
                <div class="auth__row">
                    <div class="auth__row-col">
                        <div class="auth__form-button">
                            <button type="submit" class="auth__form-submit" disabled>Напомнить</button>
                        </div>
                    </div>
                    <div class="auth__row-col">
                        <div class="auth-recovery">
                            <a href="/auth" class="link">Войти</a>
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