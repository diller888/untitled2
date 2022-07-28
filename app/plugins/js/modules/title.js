import go from './go.js';

let pageTitle = (urlTitle) => {
    urlTitle = urlTitle.replace('//', '/');
    fetch(urlTitle, {
        headers: {
            'credentials': 'same-origin',
            'X-Requested-With': 'XMLHttpRequest',
        },
        method: 'GET'
    })
        .then((res) => {
            return res.json();
        })
        .then((data) => {
            let titles = data.title;
            const mainContent = document.querySelector('.action'),
                  loader = document.querySelector(".loader");
            document.title = titles;
            mainContent.innerHTML = '';
            if (data.result == 'success') {
                if (typeof data.path !== 'undefined') {
                    var script = document.createElement('script');
                    script.setAttribute('src', data.path);
                    mainContent.appendChild(script);
                }
                if (typeof data.owner !== 'undefined') {
                    var script = document.createElement('script');
                    script.setAttribute('src', data.owner);
                    mainContents.appendChild(script);
                }
            }
            loader.classList.remove("open");
            let link = document.querySelectorAll('.link');
            init: go();
        })
}


export default pageTitle;