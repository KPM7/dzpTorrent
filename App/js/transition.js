document.addEventListener('DOMContentLoaded', function () {
    var transitionElement = document.getElementById('transition');

    window.addEventListener('load', function () {
        transitionElement.classList.add('ready');
    });

    var homeGomb = document.querySelector('#home_gomb');
    var backGomb = document.querySelector('#back_gomb');

    backGomb.addEventListener('click', function (e) {
        e.preventDefault();

        var shutdownAreaTerminal = document.querySelector('#shutdown-area-terminal');
        shutdownAreaTerminal.classList.add('shutdown');

        setTimeout(function () {
            window.location.href = "index.php";
        }, 1250);
    });

    homeGomb.addEventListener('click', function (e) {
        e.preventDefault();

        var shutdownAreaTerminal = document.querySelector('#shutdown-area-terminal');
        shutdownAreaTerminal.classList.add('shutdown');

        setTimeout(function () {
            window.location.href = "index.php";
        }, 1250);
    });
});
