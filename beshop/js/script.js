(function($) {
  document.addEventListener('DOMContentLoaded', function () {
    $('.sidenav').sidenav();
    $('.modal').modal();
    $('select').formSelect();

    let breakpoint = window.matchMedia('(min-width: 768px)');

    let homepageSlider = function () {
      let mobileSlider;
      let desktopSlider;

      if (breakpoint.matches) {
        if (mobileSlider) {
          mobileSlider.destroy();
        }

        // eslint-disable-next-line no-undef
        desktopSlider = new Swiper('.sales_header', {
          simulateTouch: false,
          slidesPerView: 'auto',
          loop: true,
          effect: 'coverflow',
          centeredSlides: true,
          centeredSlidesBounds: true,
          coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 70,
            modifier: 1,
            slideShadows: false
          },
          pagination: {
            el: '.swiper-pagination'
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
        });
      }
      else {
        if (desktopSlider) {
          desktopSlider.destroy();
        }

        // eslint-disable-next-line no-undef
        mobileSlider = new Swiper('.sales_header', {
          simulateTouch: false,
          effect: 'slide',
          loop: true,
          slidesPerView: '1',
          pagination: {
            el: '.swiper-pagination'
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
        });
      }
    };

    homepageSlider();
    breakpoint.addListener(homepageSlider);

    function showButtonsCart() {
      let item = document.querySelectorAll('.product');
      let buyButton = document.querySelectorAll('.category_order_button');
      let wrap = document.querySelector('.woocommerce');
      let orderValue = document.querySelectorAll('.category_order_capacity');
      let minusButton = document.querySelectorAll('.category_order_select_minus');
      let plusButton = document.querySelectorAll('.category_order_select_plus');
      let productNumber = document.querySelectorAll('.item_number');

      wrap.addEventListener('click', (e) => {
        for (let i = 0; i < item.length; i++) {
          if (e.target.classList.contains('category_order_button') && e.target === buyButton[i]) {
            buyButton[i].classList.add('hide_top');
            orderValue[i].classList.remove('hide_bot');
            jQuery(plusButton[i]).trigger('click')
          }
          if (e.target.classList.contains('category_order_select_minus') && e.target === minusButton[i]) {
            if (productNumber[i].value < 1) {
              buyButton[i].classList.remove('hide_top');
              orderValue[i].classList.add('hide_bot');
            }
          }
        }
      });
    }

    let categoriesView = localStorage.getItem('categoriesView');
    let classes = ['list', 'list-pic', 'grid', 'big-grid'];

    $('.category_list > div').addClass(categoriesView);

    $('.categories-switcher').on('click', function () {
      $('.category_list > div').each(function () {
        this.className = classes[($.inArray(this.className, classes) + 1) % classes.length];
        localStorage.setItem('categoriesView', this.className);
      });
    });

    // eslint-disable-next-line no-unused-vars
    function showCurrentValue() {
      let orderCapacity = document.querySelectorAll('.category_order_capacity');
      let buyButton = document.querySelectorAll('.category_order_button');
      let productNumber = document.querySelectorAll('.item_number');

      for (let i = 0; i < productNumber.length; i++) {
        if (productNumber[i].value !== 0) {
          buyButton[i].classList.add('hide_top');
          orderCapacity[i].classList.remove('hide_bot');
        }
      }
    }

    showButtonsCart();
  })
}(jQuery))
