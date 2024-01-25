document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.carousel-container');

    containers.forEach(function (container) {
        const wrapper = container.querySelectorAll('.carousel-wrapper');
        const leftBtn = container.querySelector('.left-btn');
        const rightBtn = container.querySelector('.right-btn');

        const carouselItems = container.querySelectorAll('.carousel-slide');
        
        let currentIndex = 0;
        carouselItems.forEach(function (item) {
            if (currentIndex > 3){
                item.style.opacity = '0';
            }
            currentIndex++;
        });
        currentIndex = 0;

            
        function fadeOutCurrentSlide(index) {
        const currentSlide = carouselItems[index];
        currentSlide.style.transition = 'opacity 1s';
        currentSlide.style.opacity = '0';
        }

        function fadeInCurrentSlide(index) {
        const currentSlide = carouselItems[index];
        currentSlide.style.transition = 'opacity 1s';
        currentSlide.style.opacity = '1';
        }
    
        function fadeInNextSlide() {
        const nextIndex = (currentIndex + 1) % carouselItems.length;
        const nextSlide = carouselItems[nextIndex];
        nextSlide.style.transition = 'opacity 1s';
        nextSlide.style.opacity = '1';
        }
    
        function fadeOutLastSlide() {
        const lastIndex = (currentIndex + 3 + carouselItems.length) % carouselItems.length;
        const lastSlide = carouselItems[lastIndex];
        lastSlide.style.transition = 'opacity 1s';
        lastSlide.style.opacity = '0';
        }
    
        function nextSlide() {
            fadeOutCurrentSlide(currentIndex);
            if (currentIndex == carouselItems.length - 4){
                currentIndex = 0;

                // mettre tout pour l'annimation
                for (let i = 0; i < carouselItems.length; i++) {
                    carouselItems[i].style.opacity = '1';
                }

                setTimeout(() => {
                    updateCarousel();
                }, 500);
                
                for (let i = 0; i < carouselItems.length; i++) {
                    if (i > 3){
                        carouselItems[i].style.opacity = '0';
                    } else {
                        carouselItems[i].style.opacity = '1';
                    }
                }
            } else {
                currentIndex = (currentIndex + 1) % carouselItems.length;
            }
            updateCarousel();
            fadeInCurrentSlide(currentIndex+3);
        }
    
        function prevSlide() {
            fadeOutLastSlide();
            if (currentIndex == 0){
                currentIndex = carouselItems.length - 4;

                // mettre tout pour l'annimation
                for (let i = 0; i < carouselItems.length; i++) {
                    carouselItems[i].style.opacity = '1';
                }

                setTimeout(() => {
                    updateCarousel();
                }, 500);
                
                // mettre les bonnes images en opacité 1
                for (let i = 0; i < carouselItems.length; i++) {
                    if (i < carouselItems.length - 4){
                        carouselItems[i].style.opacity = '0';
                    } else {
                        carouselItems[i].style.opacity = '1';
                    }
                }
            } else {
                currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                updateCarousel();
                fadeInCurrentSlide(currentIndex);
            }
        }
    
        function updateCarousel() {
            const wrapper = container.querySelector('.carousel-wrapper');
        
            if (wrapper) {
                const translateValue = -currentIndex * 235 + 'px';
                wrapper.style.transform = 'translateX(' + translateValue + ')';
            } else {
                console.error("Carousel wrapper not found");
            }
        }
        
    
        // Change slide on button click
        leftBtn.addEventListener('click', prevSlide);
        rightBtn.addEventListener('click', nextSlide);
    });
});
  