document.addEventListener('DOMContentLoaded', function () {
  const wrapper = document.querySelector('.carousel-wrapper');
  const leftBtn = document.querySelector('.left-btn');
  const rightBtn = document.querySelector('.right-btn');
  let currentIndex = 0;

  function nextSlide() {
      currentIndex = (currentIndex + 1) % wrapper.children.length;
      updateCarousel();
  }

  function prevSlide() {
      currentIndex = (currentIndex - 1 + wrapper.children.length) % wrapper.children.length;
      updateCarousel();
  }

  function updateCarousel() {
      const translateValue = -currentIndex * 235 + 'px';
      wrapper.style.transform = 'translateX(' + translateValue + ')';
  }

  // Change slide on button click
  leftBtn.addEventListener('click', prevSlide);
  rightBtn.addEventListener('click', nextSlide);
});
