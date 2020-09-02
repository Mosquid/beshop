(function($) {
document.addEventListener('DOMContentLoaded', function () {
    $('.sidenav').sidenav();
    $('.modal').modal();
    $('select').formSelect();

    function sales() {
        $('.sales_header').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            dots: true,
            rtl: $('body').hasClass('rtl') ? true : false,
        });
    }

     function showButtonsCart() {
        let item = document.querySelectorAll('.product'),
            buyButton = document.querySelectorAll('.category_order_button'),
            wrap = document.querySelector('.woocommerce'),
            orderValue = document.querySelectorAll('.category_order_capacity'),
            minusButton = document.querySelectorAll('.category_order_select_minus'),
            plusButton = document.querySelectorAll('.category_order_select_plus'),
            productNumber = document.querySelectorAll('.item_number');

            wrap.addEventListener('click', (e) => {

            for (let i = 0; i < item.length; i++) {
                
                if (e.target.classList.contains('category_order_button') && e.target == buyButton[i]) {
                    buyButton[i].classList.add('hide_top');
                    orderValue[i].classList.remove('hide_bot');
                    jQuery(plusButton[i]).trigger('click')
                }
                if (e.target.classList.contains('category_order_select_minus') && e.target == minusButton[i]) {
                    if(productNumber[i].value<1) {
                        buyButton[i].classList.remove('hide_top');
                        orderValue[i].classList.add('hide_bot');
                        
                    }
                    
                }

            }
        });

    }
    function showCurrentValue() {
        let orderCapacity = document.querySelectorAll('.category_order_capacity'),
        buyButton = document.querySelectorAll('.category_order_button'),
            productNumber = document.querySelectorAll('.item_number');

        for(let i = 0; i < productNumber.length; i++) {
            if(productNumber[i].value !=0) {
                buyButton[i].classList.add('hide_top');
                orderCapacity[i].classList.remove('hide_bot');
            }
        }    

    }
    
    function toggleFilters(){
        $('body').on('click','#toggle-filter,#close-filter',function(e){
            e.preventDefault();
            $('#filters-bar').toggleClass('open')
        });
    }

    sales();
    showButtonsCart();
    toggleFilters();
    
})
})(jQuery)