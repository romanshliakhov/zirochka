function initAnimatedButtons() {
  const animateButtons = document.querySelectorAll('.button--animated');
  if (!animateButtons.length) return;

  animateButtons.forEach(button => {
    let ripple = button.querySelector('span');

    if (!ripple) {
      ripple = document.createElement('span');
      button.appendChild(ripple);
    }

    button.addEventListener('mouseenter', e => {
      setRipplePosition(e, button, ripple);
    });

    button.addEventListener('mouseleave', e => {
      setRipplePosition(e, button, ripple);
    });
  });
}

function setRipplePosition(e, button, ripple) {
  const rect = button.getBoundingClientRect();
  ripple.style.left = e.clientX - rect.left + 'px';
  ripple.style.top  = e.clientY - rect.top  + 'px';
}

initAnimatedButtons();
