if (typeof profileOn === "undefined") {

    const profileOn = () => {

        let tabs = document.querySelector('.tab'),
            tabsBtn = document.querySelectorAll('.tab__item'),
            tabsContent = document.querySelectorAll('.tab__content'),
            profileEdit = document.querySelector('.profile__photo-edit');

        if (tabs) {
            tabs.addEventListener('click', (e) => {
                if (e.target.classList.contains('tab__item')) {
                    const tabsPath = e.target.dataset.tabsPath;
                    tabsBtn.forEach(el => {
                        el.classList.remove('active')
                    });
                    document.querySelector(`[data-tabs-path="${tabsPath}"]`).classList.add('active');
                    tabsHandler(tabsPath);
                }
            });
        }

        const tabsHandler = (path) => {
            tabsContent.forEach(el => {
                el.classList.remove('active')
            });
            document.querySelector(`[data-tabs-target="${path}"]`).classList.add('active');
        };

        const input = document.getElementById('avatar');
        input.addEventListener('change', () => {
            uploadAvatar(input.files[0]);
        });

        const uploadAvatar = (file) => {
            const fd = new FormData();
            fd.append('file', file);
            document.querySelector('.UploadFile').classList.remove('close-div');
            axios.request({
                method: "post",
                url: "/tpl/default/moduls/profile/action/upload.php",
                data: fd,
                onUploadProgress: (progressEvent) => {
                    const {loaded, total} = progressEvent;
                    if (loaded) {
                        var loaders = bytesToSize(loaded);
                        var totals = bytesToSize(total);
                        let progress = Math.round((loaded * 100) / total)
                        document.querySelector('.UploadProgress').style.width = progress + "%";
                        document.querySelector('.UploadLoader').innerHTML = progress + "%";
                        document.querySelector('.UploadTotal').innerHTML = '<span>' + loaders + '</span> из <span>' + totals + '</span>';
                    }
                }
            })
                .then(res => {
                    if (res.data.result == 'success') {
                        document.querySelector('.UploadTotal').innerHTML = "<i class='icon-check'></i>";
                        document.querySelector('.UploadLoader').innerHTML = "<i class='icon-close'></i>";
                        document.querySelector('.UploadFile').classList.add('close-div');
                        document.querySelector('.profile__images').innerHTML = `<img src="${res.data.src}">`;
                        document.querySelector('.profile__photo-delete').classList.remove('hidden');
                        document.querySelector('.profile__images-text').innerHTML = 'Изменить фото';
                        document.querySelector('.ava').value = res.data.id;
                    } else {
                        document.querySelector('.UploadTotal').innerHTML = `<p> ${res.data.msg} </p>`;
                        document.querySelector('.UploadLoader').innerHTML = "<i class='icon-close'></i>";
                    }
                })
        }

        function bytesToSize(bytes) {
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
            if (bytes == 0) return 'n/a'
            const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)), 10)
            if (i === 0) return `${bytes}${sizes[i]}`
            return `${(bytes / (1024 ** i)).toFixed(1)}${sizes[i]}`
        }

        const avatarDelete = document.querySelector('.profile__photo-delete');
        avatarDelete.addEventListener("click", () => {
            let id = document.querySelector('.ava').value;
            const data = new URLSearchParams();
            data.append('id', id);
            fetch('/tpl/default/moduls/profile/action/delete.php', {
                method: 'POST',
                body: data
            }).then(function (response) {
                return response.json();
            }).then(function (res) {
                if (res.result == 'success') {
                    document.querySelector('.profile__photo-delete').classList.add('hidden');
                    document.querySelector('.profile__images').innerHTML = '<i class="icon-avatar"></i><span>Нет фото</span>';
                    document.querySelector('.profile__images-text').innerHTML = 'Загрузить фото';
                } else {
                    alert(res.msg);
                }
            })
        });
        const UploadLoader = document.querySelector('.UploadLoader'),
            UploadFile   = document.querySelector('.UploadFile');
        UploadLoader.addEventListener("click", () => {
            UploadFile.classList.add('close-div');
        });


    }

    profileOn();

}