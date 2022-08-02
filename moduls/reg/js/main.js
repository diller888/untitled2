if (typeof regOn === "undefined") {
    const regOn = () => {
        let inputPhone  = document.querySelector(".phone-input"),
            logins      = document.querySelector(".login-input"),
            passw       = document.querySelector(".pass-input"),
            email       = document.querySelector(".email-input"),
            captcha     = document.querySelector(".chislo-input"),
            passShow    = document.querySelector('.pass-show'),
            formElement = document.querySelector('.form-auth'),
            loginError  = document.querySelector('.login-error'),
            phoneError  = document.querySelector('.phone-error'),
            passError   = document.querySelector('.password-error'),
            emailError  = document.querySelector('.email-error'),
            chisloError = document.querySelector('.chislo-error'),
            buttonReg   = document.querySelector('.auth__form-submit');
        var keyCode;
        function mask(event) {
            event.keyCode && (keyCode = event.keyCode);
            var pos = this.selectionStart;
            if (pos < 3) event.preventDefault();
            var matrix = "+7 (___) ___ __ __",
                i = 0,
                def = matrix.replace(/\D/g, ""),
                val = this.value.replace(/\D/g, ""),
                new_value = matrix.replace(/[_\d]/g, function(a) {
                    return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                });
            i = new_value.indexOf("_");
            if (i != -1) {
                i < 5 && (i = 3);
                new_value = new_value.slice(0, i)
            }
            var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                function(a) {
                    return "\\d{1," + a.length + "}"
                }).replace(/[+()]/g, "\\$&");
            reg = new RegExp("^" + reg + "$");
            if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
            if (event.type == "blur" && this.value.length < 5)  this.value = ""
        }
        inputPhone.addEventListener("input", mask, false);
        inputPhone.addEventListener("focus", mask, false);
        inputPhone.addEventListener("blur", mask, false);
        inputPhone.addEventListener("keydown", mask, false);
        logins.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/reg/action/login.php', {
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
        inputPhone.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/reg/action/phone.php', {
                method: 'POST',
                body: data
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.result == 'success') {
                        phoneError.classList.remove("open");
                        phoneError.classList.add("active");
                        phoneError.innerHTML = `<div class="succ"><i class="icon-check"></i></div>`;
                    } else {
                        phoneError.classList.remove("active");
                        let phoneinput = inputPhone.value;
                        if (phoneinput.length === 0) {
                            phoneError.classList.remove("open");
                        } else {
                            phoneError.classList.add("open");
                            phoneError.innerHTML = `<div class="errs"><span>${data.msg}</span><i class="icon-info-square"></i></div>`;
                        }
                    }
                });
        });
        email.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/reg/action/email.php', {
                method: 'POST',
                body: data
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.result == 'success') {
                        emailError.classList.remove("open");
                        emailError.classList.add("active");
                        emailError.innerHTML = `<div class="succ"><i class="icon-check"></i></div>`;
                    } else {
                        emailError.classList.remove("active");
                        let emailinput = email.value;
                        if (emailinput.length === 0) {
                            emailError.classList.remove("open");
                        } else {
                            emailError.classList.add("open");
                            emailError.innerHTML = `<div class="errs"><span>${data.msg}</span><i class="icon-info-square"></i></div>`;
                        }
                    }
                });
        });
        passw.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/reg/action/pass.php', {
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
                        buttonReg.disabled = false;
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
                        buttonReg.disabled = true;
                    }
                });
        });
        captcha.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                let inputlogins = logins.value;
                let inputemail = email.value;
                let inputpassw = passw.value;
                let inputphones = inputPhone.value;
                if (inputlogins.length === 0) {
                    logins.focus();
                } else if (inputemail.length === 0) {
                    email.focus();
                } else if (inputphones.length === 0) {
                    inputPhone.focus();
                } else if (inputpassw.length === 0) {
                    passw.focus();
                } else {
                    sendReg();
                }
            }
        });
        buttonReg.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector(".loader").classList.add("open");
            sendReg();
        });
        function sendReg(){
            document.querySelector(".loader>span").innerHTML = "<span class='loader__text'>Регистрация</span>";
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/reg/action/reg.php', {
                headers: {
                    'credentials': 'same-origin',
                    'X-Requested-With': 'XMLHttpRequest',
                },
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
                        }, 2000);
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
    regOn();
}