import pageTitle from './title.js';

function go() {
    const promise = new Promise((resolve, reject) => {
        let link = document.querySelectorAll(".link"),
            main = document.querySelector(".content"),
            loader = document.querySelector(".loader"),
            burger = document.querySelector(".burger"),
            navbar = document.querySelector(".navbar"),
            menu = document.querySelector(".menu");

        link.forEach(function (item, idx) {

            let url = item.getAttribute('href');

            item.addEventListener('click', e => {
                e.preventDefault();
                loader.classList.add("open");
                burger.classList.remove('open');
                menu.classList.remove('open');
                fetch(url, {
                    headers: {
                        'credentials': 'same-origin',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    method: 'GET'
                })
                    .then((result) => {
                        if (result.status != 200) {
                            throw new Error("Bad Server Response");
                        }
                        return result.text();
                    })
                    .then((content) => {
                        main.innerHTML = content;
                        navbar.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        pageTitle(url + "/?infoTitle");
                        history.pushState({nextUrl: url}, null, url);
                    })

            });

        });
    });

}

window.onpopstate = function (e) {

    let main = document.querySelector(".content");
    e.preventDefault();
    let url = e.state.nextUrl;
    fetch(url, {
        headers: {
            'credentials': 'same-origin',
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: 'GET'
    })
        .then((result) => {
            if (result.status != 200) {
                throw new Error("Bad Server Response");
            }
            return result.text();
        })
        .then((content) => {
            main.innerHTML = content;
            pageTitle(url + "/?infoTitle");
            history.replaceState({nextUrl: url}, null, url);
            go();
        })

}

export default go;
