import { gsap } from "gsap";
import { CSSRulePlugin } from "gsap/CSSRulePlugin";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(CSSRulePlugin, ScrollTrigger);

const steps = document.querySelector(".section-financial");
const pinnedTabs = document.querySelectorAll(".section-financial__wrapp");

if (document.body.classList.contains("home")) {
  let isPc = window.innerWidth >= 768;

  window.addEventListener("resize", () => {
    isPc = window.innerWidth >= 768;
  });

  if (pinnedTabs) {
    function animatePinnedCardsSection() {
      const pinnedSliderContainer = document.querySelector(".section-financial__wrapp");
      const header = document.querySelector(".header");
      const textCards = Array.from(document.querySelectorAll(".financial-card__item"));
      const cardsWrappers = Array.from(document.querySelectorAll(".financial-card"));

      if (!pinnedSliderContainer || !textCards.length || !isPc) return;

      // Скрываем карточки перед началом
      textCards.forEach((card) => {
        gsap.set(card, { opacity: 0, y: "30vh" });
      });

      // Pin секцию
      gsap.to(pinnedSliderContainer, {
        scrollTrigger: {
          trigger: ".section-financial",
          start: `top 0px`,
          end: `+=${textCards.length * 100}%`,
          scrub: 1,
          pin: true,
          anticipatePin: 1,
        },
        top: 0,
        y: 0,
      });

      // Основной scroll trigger
      ScrollTrigger.create({
        trigger: ".section-financial",
        start: `top 0px`,
        end: `+=${textCards.length * 100}%`,
        scrub: 1,
        onUpdate: (self) => {
          const progress = self.progress;
          const step = Math.min(Math.floor(progress * textCards.length), textCards.length - 1);

          textCards.forEach((card, i) => {
            const wrapper = card.parentNode;

            if (i === step) {
              if (!card.classList.contains("-active")) {
                gsap.fromTo(
                  card,
                  { y: "30vh", opacity: 0 },
                  { y: "0vh", opacity: 1, duration: 0.6, ease: "power2.out" }
                );
              }

              card.classList.add("-active");
              wrapper.classList.add("-active");
            } else {
              card.classList.remove("-active");
              wrapper.classList.remove("-active");
              gsap.set(card, { opacity: 0, y: "30vh" });
            }
          });

          // Табы
          const tabsList = pinnedSliderContainer.querySelector(".section-financial__counter");
          const tabs = tabsList.querySelectorAll(".li");

          tabs.forEach((tab, i) => {
            if (i <= step) {
              tab.classList.add("-active");
            } else {
              tab.classList.remove("-active");
            }
          });

          // Прогрессбар
          const progressBarFill = document.querySelector(".section-financial__progressbar-fill");
          if (progressBarFill) {
            const currentProgress = Math.min(step / (textCards.length - 1), 1);
            progressBarFill.style.width = `${currentProgress * 100}%`;
          }
        },
      });

      setTimeout(() => {
        ScrollTrigger.refresh(true);
      }, 100);
    }

    // Прокрутка по табам
    function scrollToPinnedTab(index, container) {
      const pinnedTabsWrapper = container.closest(".pin-spacer") || container;
      const headerHeight = document.querySelector(".header")?.offsetHeight || 0;
      const sectionTop = pinnedTabsWrapper.getBoundingClientRect().top + window.scrollY;
      const scrollLength = (pinnedTabsWrapper.offsetHeight * index) / container.querySelectorAll(".financial-card__item").length;

      const scrollTo = sectionTop + scrollLength - window.innerHeight / 2 - headerHeight;
      window.scrollTo({ top: scrollTo, behavior: "smooth" });
    }

    // Навигация по табам
    document.addEventListener("click", (event) => {
      const tab = event.target.closest(".section-financial__wrapp .li");
      if (!tab) return;

      const index = Array.from(tab.parentElement.children).indexOf(tab);
      const container = tab.closest(".section-financial__wrapp");
      scrollToPinnedTab(index, container);
    });

    // Запуск при попадании в экран с отступом вниз на 100px
    window.addEventListener("load", () => {
      const pinnedTabs = document.querySelectorAll(".section-financial__wrapp");
      if (!pinnedTabs.length) return;

      const stepsSectionObserver = new IntersectionObserver(
        (entries) => {
          if (entries[0].isIntersecting) {
            animatePinnedCardsSection();
            stepsSectionObserver.unobserve(entries[0].target);
          }
        },
        {
          rootMargin: "-100px 0px", // появление чуть ниже видимой части
          threshold: 0,
        }
      );

      pinnedTabs.forEach((tab) => stepsSectionObserver.observe(tab));
    });
  }
}
