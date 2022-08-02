import go from './modules/go.js';
import navGo from './modules/nav.js';

history.pushState({prevUrl: location.pathname}, null, location.pathname);

go();
navGo();

const burger = document.querySelector('.burger'),
      menu = document.querySelector('.menu');

burger.addEventListener("click", function() {
    burger.classList.toggle('open');
    menu.classList.toggle('open');
});