if (typeof profileSet === "undefined") {

    const profileSet = () => {

        let formSetting = document.querySelector('.form-profile'),
            passShow = document.querySelector('.form__showpass'),
            passInput = document.querySelector('.form__password'),
            formName = document.querySelector(".form--name"),
            actionName = document.querySelector(".action--name"),
            formPhone = document.querySelector(".form-tel"),
            actionPhone = document.querySelector(".action--phone"),
            formEmail = document.querySelector(".form--email"),
            formAddress = document.querySelector(".form--address"),
            showAddress = document.querySelector(".show--address"),
            actionEmail = document.querySelector(".action--email"),
            actionPass = document.querySelector(".action--pass"),
            buttonSet = document.querySelector('.form__submit'),
            formResult = document.querySelector('.form__result');

        formName.addEventListener("keyup", function (event) {
            event.preventDefault();
                let data = new URLSearchParams();
                for (const pair of new FormData(formSetting)) {
                    data.append(pair[0], pair[1]);
                }
                fetch('/tpl/default/moduls/profile/action/setting/name.php', {
                    method: 'POST',
                    body: data
                })
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        if (data.result == 'success') {
                            actionName.innerHTML = data.msg;
                        } else {
                            actionName.innerHTML = `<span>${data.msg}</span>`;
                        }
                    });

        });
        formName.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                document.querySelector(".loader").classList.add("open");
                sendSet();
            }
        });
        formPhone.addEventListener("keyup", function (event) {
            event.preventDefault();
                let data = new URLSearchParams();
                for (const pair of new FormData(formSetting)) {
                    data.append(pair[0], pair[1]);
                }
                fetch('/tpl/default/moduls/profile/action/setting/phone.php', {
                    method: 'POST',
                    body: data
                })
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        if (data.result == 'success') {
                            actionPhone.innerHTML = data.msg;
                        } else {
                            actionPhone.innerHTML = `<span>${data.msg}</span>`;
                        }
                    });

        });
        formPhone.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                document.querySelector(".loader").classList.add("open");
                sendSet();
            }
        });
        formEmail.addEventListener("keyup", function (event) {
            event.preventDefault();
                let data = new URLSearchParams();
                for (const pair of new FormData(formSetting)) {
                    data.append(pair[0], pair[1]);
                }
                fetch('/tpl/default/moduls/profile/action/setting/email.php', {
                    method: 'POST',
                    body: data
                })
                    .then((response) => {
                        return response.json();
                    })
                    .then((data) => {
                        if (data.result == 'success') {
                            actionEmail.innerHTML = data.msg;
                        } else {
                            actionEmail.innerHTML = `<span>${data.msg}</span>`;
                        }
                    });

        });
        formEmail.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                document.querySelector(".loader").classList.add("open");
                sendSet();
            }
        });
        passInput.addEventListener("keyup", function (event) {
            event.preventDefault();
            let data = new URLSearchParams();
            for (const pair of new FormData(formSetting)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/tpl/default/moduls/profile/action/setting/pass.php', {
                method: 'POST',
                body: data
            })
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    if (data.result == 'success') {
                        actionPass.innerHTML = data.msg;
                    } else {
                        actionPass.innerHTML = `<span>${data.msg}</span>`;
                    }
                });

        });
        passInput.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                document.querySelector(".loader").classList.add("open");
                sendSet();
            }
        });

        formAddress.addEventListener('keydown', function (event) {
            if (event.code === 'Enter') {
                document.querySelector(".loader").classList.add("open");
                sendSet();
            }
        });

        passShow.addEventListener("click", function (event) {
            passInput.classList.toggle("open");
            passShow.classList.toggle("active");
        });

        buttonSet.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector(".loader").classList.add("open");
            sendSet();
        });

        function sendSet(){
            document.querySelector(".loader>span").innerHTML = "<span class='loader__text'>Сохранение</span>";
            formResult.innerHTML = "";
            let data = new URLSearchParams();
            for (const pair of new FormData(formSetting)) {
                data.append(pair[0], pair[1]);
            }
            fetch('/tpl/default/moduls/profile/action/setting/save.php', {
                method: 'POST',
                body: data
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (res) {
                    if (res.result == 'success') {
                        setTimeout(function () {
                            document.querySelector(".loader>span").innerHTML = "";
                            document.querySelector(".loader").classList.remove("open");
                            formResult.innerHTML = 'Сохранено';
                            setTimeout(function () {
                                formResult.innerHTML = '';
                            }, 5000);
                        }, 2000);
                    } else {
                        formResult.innerHTML = `<span>${res.msg}</span>`;
                        document.querySelector(".loader>span").innerHTML = "";
                        document.querySelector(".loader").classList.remove("open");
                    }
                })
                .catch(function (error) {
                    alert('Request failed', error);
                });
        }

        maskPhone(".form-tel");
        function maskPhone(selector, masked = '+7 (___) ___ __ __') {
            const elems = document.querySelectorAll(selector);

            function mask(event) {
                const keyCode = event.keyCode;
                const template = masked,
                    def = template.replace(/\D/g, ""),
                    val = this.value.replace(/\D/g, "");
                let i = 0,
                    newValue = template.replace(/[_\d]/g, function (a) {
                        return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
                    });
                i = newValue.indexOf("_");
                if (i !== -1) {
                    newValue = newValue.slice(0, i);
                }
                let reg = template.substr(0, this.value.length).replace(/_+/g,
                    function (a) {
                        return "\\d{1," + a.length + "}";
                    }).replace(/[+()]/g, "\\$&");
                reg = new RegExp("^" + reg + "$");
                if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) {
                    this.value = newValue;
                }
                if (event.type === "blur" && this.value.length < 5) {
                    this.value = "";
                }

            }

            for (const elem of elems) {
                elem.addEventListener("input", mask);
                elem.addEventListener("focus", mask);
                elem.addEventListener("blur", mask);
            }

        }
    }
    profileSet();

}