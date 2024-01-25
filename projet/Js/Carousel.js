document.addEventListener('DOMContentLoaded', function () {
    const wrapper = document.querySelector('.carousel-wrapper');
    const leftBtn = document.querySelector('.left-btn');
    const rightBtn = document.querySelector('.right-btn');
    let currentIndex = 0;

    for (let i = 0; i < wrapper.children.length; i++) {
        if (i > 3){
            wrapper.children[i].style.opacity = '0';
        }
    }   
        
    function fadeOutCurrentSlide(index) {
      const currentSlide = wrapper.children[index];
      currentSlide.style.transition = 'opacity 1s';
      currentSlide.style.opacity = '0';
    }

    function fadeInCurrentSlide(index) {
      const currentSlide = wrapper.children[index];
      currentSlide.style.transition = 'opacity 1s';
      currentSlide.style.opacity = '1';
    }
  
    function fadeInNextSlide() {
      const nextIndex = (currentIndex + 1) % wrapper.children.length;
      const nextSlide = wrapper.children[nextIndex];
      nextSlide.style.transition = 'opacity 1s';
      nextSlide.style.opacity = '1';
    }
  
    function fadeOutLastSlide() {
      const lastIndex = (currentIndex + 3 + wrapper.children.length) % wrapper.children.length;
      const lastSlide = wrapper.children[lastIndex];
      lastSlide.style.transition = 'opacity 1s';
      lastSlide.style.opacity = '0';
    }
  
    function nextSlide() {
        fadeOutCurrentSlide(currentIndex);
        if (currentIndex == wrapper.children.length - 4){
            currentIndex = 0;

            // mettre tout pour l'annimation
            for (let i = 0; i < wrapper.children.length; i++) {
                wrapper.children[i].style.opacity = '1';
            }

            setTimeout(() => {
                updateCarousel();
            }, 500);
            
            for (let i = 0; i < wrapper.children.length; i++) {
                if (i > 4){
                    wrapper.children[i].style.opacity = '0';
                } else {
                    wrapper.children[i].style.opacity = '1';
                }
            }
        } else {
            currentIndex = (currentIndex + 1) % wrapper.children.length;
        }
        updateCarousel();
        fadeInCurrentSlide(currentIndex+3);
    }
  
    function prevSlide() {
        fadeOutLastSlide();
        if (currentIndex == 0){
            currentIndex = wrapper.children.length - 4;

            // mettre tout pour l'annimation
            for (let i = 0; i < wrapper.children.length; i++) {
                wrapper.children[i].style.opacity = '1';
            }

            setTimeout(() => {
                updateCarousel();
            }, 500);
            
            // mettre les bonnes images en opacité 1
            for (let i = 0; i < wrapper.children.length; i++) {
                if (i < wrapper.children.length - 4){
                    wrapper.children[i].style.opacity = '0';
                } else {
                    wrapper.children[i].style.opacity = '1';
                }
            }
        } else {
            currentIndex = (currentIndex - 1 + wrapper.children.length) % wrapper.children.length;
            updateCarousel();
            fadeInCurrentSlide(currentIndex);
        }
    }
  
    function updateCarousel() {
        const translateValue = -currentIndex * 235 + 'px';
        wrapper.style.transform = 'translateX(' + translateValue + ')';
    }
  
    // Change slide on button click
    leftBtn.addEventListener('click', prevSlide);
    rightBtn.addEventListener('click', nextSlide);
  });
  