document.addEventListener("DOMContentLoaded", () => {
  const ratingBlocks = document.querySelectorAll('.testimonial-card__ratings');
  
  if (ratingBlocks.length === 0) return;

  ratingBlocks.forEach(ratingBlock => {
      const stars = parseInt(ratingBlock.dataset.stars, 10);
      const starElements = ratingBlock.querySelectorAll('span');

      starElements.forEach((star, index) => {
          if (index < stars) {
              star.classList.add('filled');
          }
      });
  });
});