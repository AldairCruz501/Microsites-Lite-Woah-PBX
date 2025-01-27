      document.addEventListener('DOMContentLoaded', function () {
        const liItems = document.querySelectorAll('.izq-ser li');
        const sections = document.querySelectorAll('.der-ser section');
    
        // Oculta todas las secciones excepto la primera al cargar la página
        for (let i = 1; i < sections.length; i++) {
          sections[i].style.display = 'none';
        }
    
        liItems.forEach((item, index) => {
          item.addEventListener('click', (event) => {
            if (window.innerWidth < 868) {
              event.preventDefault();
              // Scroll suave a la sección correspondiente en modo responsive
              sections[index].scrollIntoView({ behavior: 'smooth' });
              liItems.forEach(li => {
                li.classList.remove('active-ser');
              });
              item.classList.add('active-ser');
            } else {
              sections.forEach(section => {
                section.style.display = 'none';
              });
              sections[index].style.display = 'block';
              liItems.forEach(li => {
                li.classList.remove('active-ser');
              });
              item.classList.add('active-ser');
            }
          });
        });
    
        function checkScreenWidth() {
          if (window.innerWidth >= 1200) {
            // Deshabilitar los enlaces a las anclas en pantallas grandes
            liItems.forEach(item => {
              item.removeEventListener('click', toggleSections);
            });
          } else if (window.innerWidth >= 868) {
            // Mostrar solo la primera sección en modo desktop
            sections.forEach((section, index) => {
              if (index === 0) {
                section.style.display = 'block';
              } else {
                section.style.display = 'none';
              }
            });
            activateLinks(false);
          } else {
            sections.forEach(section => {
              section.style.display = 'none';
            });
            activateLinks(true);
          }
        }
    
        function activateLinks(activate) {
          liItems.forEach((item, index) => {
            if (activate) {
              item.addEventListener('click', () => {
                if (window.innerWidth < 868) {
                  sections[index].scrollIntoView({ behavior: 'smooth' });
                  liItems.forEach(li => {
                    li.classList.remove('active-ser');
                  });
                  item.classList.add('active-ser');
                }
              });
            } else {
              item.removeEventListener('click', toggleSections);
            }
          });
        }
    
        checkScreenWidth();
        window.addEventListener('resize', checkScreenWidth);
      });