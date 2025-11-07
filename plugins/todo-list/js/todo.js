document.addEventListener('DOMContentLoaded', () => {
  const slideEls = document.querySelectorAll('.slide-in');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.2 });

  slideEls.forEach((el) => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
  });
});
