import pageTitle from './title.js';
import go from "./go.js";

function navGo() {

    const promise = new Promise((resolve, reject) => {
        const linkmenu = document.querySelectorAll(".menu__link"),
            maincontent = document.querySelector(".content"),
            loader = document.querySelector(".loader"),
            burger = document.querySelector(".burger"),
            navbar = document.querySelector(".navbar"),
            menu = document.querySelector(".menu");

        linkmenu.forEach(function (items, idx) {

            let url = items.getAttribute('href');

            items.addEventListener('click', e => {
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
                            document.querySelector(".loader>span").innerHTML = "<span class='loader__text'>Bad Server Response</span>";
                            throw new Error("Bad Server Response");
                        }
                        return result.text();
                    })
                    .then((content) => {
                        if (window.history.state.prevUrl !== url) {
                            maincontent.innerHTML = content;
                            navbar.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                            pageTitle(url + "/?infoTitle");
                            history.pushState({prevUrl: url}, null, url);
                        } else {
                            document.querySelector(".loader").classList.remove("open");
                        }
                    })

            });

        });

    });

}

window.onpopstate = function (e) {

    let main = document.querySelector(".content");
    e.preventDefault();

    if (window.history.state) {
        let url = e.state.prevUrl;
        let urlPrev = url.replace('//', '/');
        fetch(urlPrev, {
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
                go();
            })
    }
}
export default navGo;