  // Script para mostrar/ocultar secciones
  function mostrarid(id) {
    var secciones = document.getElementsByClassName('cont-sol');
    for (var i = 0; i < secciones.length; i++) {
        secciones[i].style.display = 'none';
    }

    var elemento = document.getElementById(id);
    elemento.style.display = 'flex';

    var elementosLista = document.getElementsByTagName('li');
    for (var i = 0; i < elementosLista.length; i++) {
        elementosLista[i].classList.remove('active');
    }

    var elementoClic = document.querySelector('li[onclick="mostrarid(\'' + id + '\')"]');
    elementoClic.classList.add('active');
}

mostrarid('redes');


document.addEventListener('DOMContentLoaded', function() {
  

    // Script para hover en elementos con clase .cont-ser-sq
    const contSerSq = document.querySelectorAll('.cont-ser-sq');
    contSerSq.forEach(element => {
        element.addEventListener('mouseover', function() {
            const pHover = this.querySelector('.p-hover');
            pHover.style.display = 'block';
        });

        element.addEventListener('mouseout', function() {
            const pHover = this.querySelector('.p-hover');
            pHover.style.display = 'none';
        });
    });

    // Script para el menú toggle
    const toggleBtn = document.querySelector('.btn-toggle');
    const enlaces = document.querySelector('.enlaces');
    const enlacesList = document.querySelectorAll('.enlaces a'); // Agregado

    toggleBtn.addEventListener('click', function() {
        enlaces.classList.toggle('show');
    });

    enlacesList.forEach(enlace => { // Agregado
        enlace.addEventListener('click', function() {
            enlaces.classList.remove('show'); // Oculta el menú al hacer clic en un enlace
        });
    });
});
