


window.addEventListener('load', () => {

    navbar();
});
//window.onload = navbar();


function navbar() {

    let navegador = document.querySelector('#navegador');

    fetch('./js/navbar.html')
        .then((response) => response.text())
        .then((text) => navegador.innerHTML = text)
        .then(() => colorear());



};

function colorear() {
    let color = document.querySelectorAll('a');
    color.forEach((elemment) => {
        if (location.href == elemment["href"]) {
            elemment.firstChild.style = ('background-color:blue;color:white;');
        }

    });

}

