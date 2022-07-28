if (typeof mainOn === "undefined") {
    const mainOn = () => {
        let calls = document.querySelector(".btn-call");
        calls.addEventListener('click', function () {
            calls.classList.add('open');
        });
    }
    mainOn();
}
