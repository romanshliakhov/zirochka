import { gsap } from "gsap";
import { CSSRulePlugin } from "gsap/CSSRulePlugin";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(CSSRulePlugin, ScrollTrigger);

gsap.utils.toArray('[data-parallax-wrapper]').forEach(container => {
  const img = container.querySelector(['[data-parallax-target]']);

  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: container,
      scrub: true
    }
  })

  tl.fromTo(img, {
    yPercent: -15,
    ease: 'none'
  }, {
    yPercent: 15,
    ease: 'none'
  })
})

const servicesCol = document.querySelectorAll('.section-types__item');

servicesCol.forEach(col => {
  col.addEventListener('mouseenter', () => {
    servicesCol.forEach(i => {
      i.classList.remove('active');
      col.classList.add('active');
    })
  })
})



