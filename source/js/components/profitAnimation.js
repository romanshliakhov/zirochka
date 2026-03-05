document.addEventListener('DOMContentLoaded', () => {
  const timelines = document.querySelectorAll('.section-profit__timeline');

  if (!timelines.length) return; // Ничего не делать, если блоков нет

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startTimelineAnimation(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.4
  });

  timelines.forEach(timeline => {
    observer.observe(timeline);
  });

  function startTimelineAnimation(timeline) {
    timeline.classList.add('active');

    const steps = [
      timeline.querySelector('.profit-start'),
      ...timeline.querySelectorAll('.profit-step'),
      timeline.querySelector('.profit-end'),
    ].filter(Boolean); // Убираем null, если чего-то не хватает

    const totalSteps = steps.length;
    const duration = 1500;
    const delayBetween = duration / totalSteps;

    steps.forEach((el, index) => {
      setTimeout(() => {
        el.classList.add('active');
      }, index * delayBetween);
    });
  }
});
