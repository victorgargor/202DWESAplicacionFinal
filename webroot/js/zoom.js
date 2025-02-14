/**
 * @author Víctor García Gordón
 * @version Fecha de última modificación 13/02/2025
 */
document.addEventListener('DOMContentLoaded', () => {
  const heroes = [
    document.getElementById('heroBg'),
    document.getElementById('heroBg2'),
    document.getElementById('heroBg3'),
    document.getElementById('heroBg5'),
    document.getElementById('heroBg6')
  ];

  let zoomedHero = null;
  let scaleFactor = 1;

  // Función para actualizar la transformación del héroe
  function updateTransform(target, originX, originY) {
    target.style.transformOrigin = `${originX}% ${originY}%`;
    target.style.transform = `scale(${scaleFactor})`;
  }

  // Función para aplicar zoom donde se hace clic
  function handleZoom(e, target) {
    const rect = target.getBoundingClientRect();
    const x = ((e.clientX - rect.left) / rect.width) * 100;
    const y = ((e.clientY - rect.top) / rect.height) * 100;

    if (zoomedHero === target) {
      zoomedHero = null;
      scaleFactor = 1;
      target.style.cursor = 'zoom-in';
    } else {
      zoomedHero = target;
      scaleFactor = 2.5;
      target.style.cursor = 'zoom-out';
    }
    updateTransform(target, x, y);
  }

  // Agregar eventos a cada hero
  heroes.forEach(hero => {
    hero.addEventListener('click', (e) => handleZoom(e, hero));

    // Zoom con la rueda del ratón
    hero.addEventListener('wheel', (e) => {
      if (zoomedHero === hero) {
        e.preventDefault();
        const rect = hero.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        scaleFactor += e.deltaY * -0.01;
        scaleFactor = Math.min(Math.max(1, scaleFactor), 5);
        updateTransform(hero, x, y);
      }
    });
  });
});






