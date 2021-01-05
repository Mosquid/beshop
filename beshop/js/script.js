(function($) {
  document.addEventListener('DOMContentLoaded', function () {
    $('.sidenav').sidenav();
    $('.modal').modal();
    $('select').formSelect();

    function sales() {
      $('.sales_header').slick({
        centerMode: true,
        centerPadding: 0,
        slidesToShow: 3,
        dots: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: false,
              centerMode: true,
              slidesToShow: 1
            }
          }
        ]
      });
    }

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

    sales();
    showButtonsCart();
  })
}(jQuery))
