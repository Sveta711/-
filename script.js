 document.addEventListener('DOMContentLoaded', () => {
    const carouselWrapper = document.getElementById('carousel');
    const carousel = document.querySelector('.cards');
    const cards = document.querySelectorAll('.carddiv');
    const prevArrow = document.querySelector('.prev-arrow');
    const nextArrow = document.querySelector('.next-arrow');

    if (!carouselWrapper || !carousel || cards.length === 0) {
        console.error("Carousel elements not fully found. Script cannot run.");
        return;
    }

    let currentIndex =0;
    const cardFullWidth = 200; 
    
    
    function updateCarousel() {
        
        const wrapperWidth = carouselWrapper.offsetWidth;
        const currentCardCenter = currentIndex * cardFullWidth + (cardFullWidth / 10);;
        if(currentIndex<4){
        const translateX = currentCardCenter-200;
         carousel.style.transform = `translateX(-${translateX}px)`;}
        cards.forEach((card, index) => {
            const isCentered = index === currentIndex;
            card.classList.toggle('is-centered', isCentered);

            if (isCentered) {
                card.style.transform = 'scale(1)'; 
                card.style.opacity = '1';
            } else {
                card.style.transform = 'scale(0.85)'; 
                card.style.opacity = '0.7';
            }
        });
        prevArrow.disabled = currentIndex === 0;
        nextArrow.disabled = currentIndex === cards.length -1;
    }
    function nextCard() {
        if (currentIndex < cards.length ) {
            currentIndex++;
            updateCarousel();
        }
    }
    function prevCard() {
        if (currentIndex >0) {
            currentIndex--;
            updateCarousel();
        }
    }
    prevArrow.addEventListener('click', prevCard);
    nextArrow.addEventListener('click', nextCard);
    updateCarousel();

    window.addEventListener('resize', updateCarousel);
});


document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconMenu = document.getElementById('icon-menu');
    const iconClose = document.getElementById('icon-close');

    if (menuBtn && mobileMenu && iconMenu && iconClose) {
        menuBtn.addEventListener('click', () => {
            const isMenuVisible = mobileMenu.classList.contains('hidden');

            if (isMenuVisible) {
                mobileMenu.classList.remove('hidden');
                iconMenu.classList.add('hidden');
                iconClose.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; 
            } else {
                mobileMenu.classList.add('hidden');
                iconMenu.classList.remove('hidden');
                iconClose.classList.add('hidden');
                document.body.style.overflow = ''; 
            }
        });
    }
});// aysqany miayn en romance,fantasy i hamar


