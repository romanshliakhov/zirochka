document.addEventListener('DOMContentLoaded', () => {
  const roadmap = document.querySelector('.section-roadmap__items');
  const items = document.querySelectorAll('.section-roadmap__item');

  if (!roadmap || !items.length) return;

  const totalItems = items.length;
  let activatedItems = 0;

  const updateLine = () => {
    const percent = (activatedItems / totalItems) * 100;
    roadmap.style.setProperty('--fill-height', `${percent}%`);
  };

  const createObserver = (threshold) => {
    return new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        const item = entry.target;
        const counter = item.querySelector('.section-roadmap__item-counter');

        if (entry.isIntersecting && !item.classList.contains('active')) {
          item.classList.add('active');              // Добавляем класс активному item
          counter.classList.add('active');           // Оставляем, если нужна анимация счётчика
          activatedItems++;
          updateLine();
          obs.unobserve(item); // Отключаем наблюдение после активации
        }
      });
    }, { threshold });
  };

  const firstObserver = createObserver(0.4);
  const otherObserver = createObserver(0.6);

  items.forEach((item, index) => {
    if (index === 0) {
      firstObserver.observe(item);
    } else {
      otherObserver.observe(item);
    }
  });
});
