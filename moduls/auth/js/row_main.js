if (typeof recoveryOn === "undefined") {
    const recoveryOn = () => {
        let recovery = document.querySelector(".recovery-input"),
            captcha = document.querySelector(".captcha-input"),
            formElement = document.querySelector('.form-recovery'),
            recoveryError = document.querySelector('.recovery-error'),
            captchaError = document.querySelector('.captcha-error'),
            buttonRecovery = document.querySelector('.auth__form-submit');
        recovery.addEventListener("keyup", function (event) {
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
                        recoveryError.classList.remove("open");
                        recoveryError.classList.add("active");
                        recoveryError.innerHTML = `<div class="succ"><i class="icon-check"></i></div>`;
                    } else {
                        recoveryError.classList.remove("active");
                        let recoveryinput = recovery.value;
                        if (recoveryinput.length === 0) {
                            recoveryError.classList.remove("open");
                            recoveryError.innerHTML = '';
                        } else {
                            recoveryError.classList.add("open");
                            recoveryError.innerHTML = `<div class="errs"><span>${data.msg}</span><i class="icon-info-square"></i></div>`;
                        }
                    }
                });
        });
        recovery.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                let inputcaptcha = captcha.value;
                if (inputcaptcha.length === 0) {
                    captcha.focus();
                } else {
                    sendRecovery();
                }
            }
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
                        captchaError.classList.remove("open");
                        captchaError.classList.add("active");
                        captchaError.innerHTML = `<div class="succ"><i class="icon-check"></i></div>`;
                        buttonRecovery.disabled = false;
                    } else {
                        captchaError.classList.remove("active");
                        let captchainput = captcha.value;
                        if (captchainput.length === 0) {
                            captchaError.classList.remove("open");
                            captchaError.innerHTML = '';
                        } else {
                            captchaError.classList.add("open");
                            captchaError.innerHTML = `<div class="errs"><span>${data.msg}</span><i class="icon-info-square"></i></div>`;
                        }
                        buttonRecovery.disabled = true;
                    }
                });
        });
        captcha.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                let inputrecovery = recovery.value;
                if (inputrecovery.length === 0) {
                    recovery.focus();
                } else {
                    sendRecovery();
                }
            }
        });
        buttonRecovery.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector(".loader").classList.add("open");
            sendRecovery();
        });

        function sendRecovery() {
            document.querySelector(".loader>span").innerHTML = "<span class='loader__text'>Идет отправка</span>";
            let data = new URLSearchParams();
            for (const pair of new FormData(formElement)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/moduls/auth/action/recovery.php', {
                method: 'POST',
                body: data
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (res) {
                    if (res.result == 'success') {
                        setTimeout(function () {
                            document.querySelector(".auth__result").innerHTML = `<p>${res.msg}</p>`;
                            document.querySelector(".loader").classList.remove("open");
                            document.querySelector(".loader>span").innerHTML = "";
                        }, 1500);
                    } else {
                        document.querySelector(".loader>span").innerHTML = "";
                        document.querySelector(".auth__result").innerHTML = `<span>${res.msg}</span>`;
                        document.querySelector(".loader").classList.remove("open");
                    }
                })
                .catch(function (error) {
                    alert('Request failed', error);
                });
        }
    }
    recoveryOn();
}