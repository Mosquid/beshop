/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */
(function($) {
  document.addEventListener('DOMContentLoaded', function () {
    $('.sidenav').sidenav();
    $('.modal').modal();
    $('select').formSelect();

    let breakpoint = window.matchMedia('(min-width: 768px)');

    let homepageSlider = function () {
      if (breakpoint.matches) {
        let desktopSlider = new Swiper('.sales_header', {
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
        let mobileSlider = new Swiper('.sales_header', {
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

    function desktopSearch() {
      let searchButton = document.querySelector('.open-search');
      let searchWidget = document.querySelector('.widget_search');
      let searchInput = document.querySelector('.widget_search .search-field');

      searchButton.onclick = function(event) {
        event.stopPropagation();
        searchWidget.classList.toggle('active');
        searchInput.focus();
      }

      document.addEventListener('click', function(event) {
        if (searchWidget.classList.contains('active')) {
          let isClickInside = searchInput.contains(event.target);

          if (!isClickInside) {
            searchWidget.classList.toggle('active');
          }
        }
      });
    }

    desktopSearch();

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

    if (categoriesView) {
      $('.category_list > div').removeClass();
      $('.category_list > div').addClass(categoriesView);
    }

    $('.categories-switcher').on('click', function () {
      $('.category_list > div').each(function () {
        this.className = classes[($.inArray(this.className, classes) + 1) % classes.length];
        localStorage.setItem('categoriesView', this.className);
      });
    });

    // Filter button
    if ($('.product-filter').length) {
      $('.filter-switcher').click(function() {
        $(this).toggleClass('active');
        $(this).next('.filter-wrapper').toggleClass('active');
      });
    }

    // Cart logic
    if ($('.woocommerce-cart-form').length) {
      $(window).on('load', function() {
        $("[name='update_cart']").removeAttr('disabled');
      });

      $(document.body).on('updated_cart_totals', function () {
        $("[name='update_cart']").removeAttr('disabled');
      });

      $('div.woocommerce').on('change', '.qty', function () {
        $("[name='update_cart']").trigger('click');
      });

      if (!String.prototype.getDecimals) {
        // eslint-disable-next-line no-extend-native
        String.prototype.getDecimals = function () {
          let num = this;
          let match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);

          if (!match) {
            return 0;
          }

          return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        }
      }

      // Quantity "plus" and "minus" buttons
      $(document.body).on('click', '.plus, .minus', function () {
        let $qty = $(this).closest('.quantity').find('.qty');
        let currentVal = parseFloat($qty.val());
        let max = parseFloat($qty.attr('max'));
        let min = parseFloat($qty.attr('min'));
        let step = $qty.attr('step');

        // Format values
        if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
        if (max === '' || max === 'NaN') max = '';
        if (min === '' || min === 'NaN') min = 0;
        // eslint-disable-next-line no-undefined
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

        // Change the value
        if ($(this).is('.plus')) {
          if (max && (currentVal >= max)) {
            $qty.val(max);
          }
          else {
            $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
          }
        }
        else {
          // eslint-disable-next-line no-lonely-if
          if (min && (currentVal <= min)) {
            $qty.val(min);
          }
          else if (currentVal > 0) {
            $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
          }
        }

        // Trigger change event
        $qty.trigger('change');
      });
    }

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
  });
}(jQuery))
