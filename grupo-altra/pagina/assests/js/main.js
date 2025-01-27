const rectangulos = document.querySelectorAll('.rectangulo');

rectangulos.forEach(rectangulo => {
  rectangulo.addEventListener('click', () => {
    rectangulos.forEach(r => {
      r.classList.remove('activo');
    });
    rectangulo.classList.add('activo');
  });
});
