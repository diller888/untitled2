if (typeof authOn === "undefined") {
    const authOn = () => {
        let logins = document.querySelector(".login-input"),
            passw = document.querySelector(".pass-input"),
            captcha = document.querySelector(".chislo-input"),
            passShow = document.querySelector('.pass-show'),
            formElement = document.querySelector('.form-auth'),
            loginError = document.querySelector('.login-error'),
            passError = document.querySelector('.password-error'),
            chisloError = document.querySelector('.chislo-error'),
            buttonAuth = document.querySelector('.auth__form-submit');
        logins.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/auth/action/check.php', {
                method: 'POST',
                body: data
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.result == 'success') {
                        loginError.classList.remove("open");
                        loginError.classList.add("active");
                        loginError.innerHTML = `<div class="succ"><i class="icon-check"></i></div>`;
                    } else {
                        loginError.classList.remove("active");
                        let loginsinput = logins.value;
                        if (loginsinput.length === 0) {
                            loginError.classList.remove("open");
                            loginError.innerHTML = '';
                        } else {
                            loginError.classList.add("open");
                            loginError.innerHTML = `<div class="errs"><span>${data.msg}</span><i class="icon-info-square"></i></div>`;
                        }
                    }
                });
        });
        logins.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                let inputpass = passw.value;
                let inputcaptcha = captcha.value;
                if (inputpass.length === 0) {
                    passw.focus();
                } else if (inputcaptcha.length === 0) {
                    captcha.focus();
                } else {
                    sendAuth();
                }
            }
        });
        passw.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/auth/action/pass.php', {
                method: 'POST',
                body: data
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.result == 'success') {
                        passError.classList.remove("open");
                        passError.classList.add("active");
                        passError.innerHTML = `<div class="succ"><i class="icon-check"></i></div>`;
                    } else {
                        passError.classList.remove("active");
                        let passinput = passw.value;
                        if (passinput.length === 0) {
                            passError.classList.remove("open");
                            passShow.classList.remove("open");
                            passError.innerHTML = '';
                        } else {
                            passError.classList.add("open");
                            passShow.classList.add("open");
                            passError.innerHTML = `<div class="errs"><span>${data.msg}</span><i class="icon-info-square"></i></div>`;
                        }
                    }
                });
        });
        passw.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                let inputlogins = logins.value;
                let inputcaptcha = captcha.value;
                if (inputlogins.length === 0) {
                    logins.focus();
                } else if (inputcaptcha.length === 0) {
                    captcha.focus();
                } else {
                    sendAuth();
                }
            }
        });
        passShow.addEventListener("click", function (event) {
            passw.classList.toggle("pass-inputopen");
            passShow.classList.toggle("active");
        });
        captcha.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/auth/action/captcha.php', {
                method: 'POST',
                body: data
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.result == 'success') {
                        chisloError.classList.remove("open");
                        chisloError.classList.add("active");
                        chisloError.innerHTML = `<div class="succ"><i class="icon-check"></i></div>`;
                        buttonAuth.disabled = false;
                    } else {
                        chisloError.classList.remove("active");
                        let captchainput = captcha.value;
                        if (captchainput.length === 0) {
                            chisloError.classList.remove("open");
                            chisloError.innerHTML = '';
                        } else {
                            chisloError.classList.add("open");
                            chisloError.innerHTML = `<div class="errs"><span>${data.msg}</span><i class="icon-info-square"></i></div>`;
                        }
                        buttonAuth.disabled = true;
                    }
                });
        });
        captcha.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                let inputlogins = logins.value;
                let inputpassw = passw.value;
                if (inputlogins.length === 0) {
                    logins.focus();
                } else if (inputpassw.length === 0) {
                    passw.focus();
                } else {
                    sendAuth();
                }
            }
        });
        buttonAuth.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector(".loader").classList.add("open");
            sendAuth();
        });

        function sendAuth(){
            document.querySelector(".loader>span").innerHTML = "<span class='loader__text'>Авторизация</span>";
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/auth/action/auth.php', {
                method: 'POST',
                body: data
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (res) {
                    if (res.result == 'success') {
                        setTimeout(function () {
                            window.location.assign("/profile");
                            location.replace("/profile");
                            document.location = "/profile";
                        }, 1500);
                    } else {
                        document.querySelector(".loader>span").innerHTML = "";
                        document.querySelector(".loader").classList.remove("open");
                    }
                })
                .catch(function (error) {
                    alert('Request failed', error);
                });
        }
    }
    authOn();
}
