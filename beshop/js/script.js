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
            dots: true
        });
    }

    //    function calculateValue() {
    //        let orderValue = document.querySelectorAll('.category_order_capacity'),
    //            numberValue = document.querySelectorAll('.value_number');
    //        for (i = 0; i < orderValue.length; i++) {
    //            orderValue[i].innerHTML = numberValue[i].innerHTML;
    //        }
    //    }

    function showButtonsCart() {
        let item = document.querySelectorAll('.product'),
            buyButton = document.querySelectorAll('.category_order_button'),
            wrap = document.querySelector('.woocommerce'),
            orderValue = document.querySelectorAll('.category_order_capacity'),
            numberValue = document.querySelectorAll('.value_number'),
            minusButton = document.querySelectorAll('.category_order_select_minus'),
            plusButton = document.querySelectorAll('.category_order_select_plus');

            wrap.addEventListener('click', (e) => {

            for (let i = 0; i < item.length; i++) {
                
                if (e.target.classList.contains('category_order_button') && e.target == buyButton[i]) {
                    console.log(1);
                    buyButton[i].classList.add('hide_top');
                    orderValue[i].classList.remove('hide_bot');
                    minusButton[i].classList.remove('hide_opacity');
                    plusButton[i].classList.remove('hide_opacity');

                }

            }
        });


    }

    //    function changeValue() {
    //        let item = document.querySelectorAll('.category_list_item'),
    //            buyButton = document.querySelectorAll('.category_order_button'),
    //            wrap = document.querySelector('.category_list'),
    //            orderValue = document.querySelectorAll('.category_order_capacity'),
    //            numberValue = document.querySelectorAll('.value_number'),
    //            metricValue = document.querySelectorAll('.value_metric'),
    //            minusButton = document.querySelectorAll('.category_order_select_minus'),
    //            wrapButton = document.querySelectorAll('.category_order_select'),
    //            plusButton = document.querySelectorAll('.category_order_select_plus');
    //            let cap = 1; /*capacity of ordered product*/
    //
    //        wrap.addEventListener('click', (e) => {
    //            
    //            for (let i = 0; i < item.length; i++) {
    //                
    //                let currentValue = orderValue[i].innerHTML;
    //                if (e.target.classList.contains('category_order_select_plus') && e.target == plusButton[i]) {
    //                    currentValue = +currentValue[i] + +numberValue[i].innerHTML;
    //                    orderValue[i].innerHTML = currentValue + ' ' + metricValue[i].innerHTML;
    //                    ++cap;
    //                    console.log(cap);
    //                }
    //                if (e.target.classList.contains('category_order_select_minus') && e.target == minusButton[i]) {
    //                    --cap;
    //                    if (cap > 0) {
    //                        currentValue = +currentValue[i] - +numberValue[i].innerHTML;
    //                        orderValue[i].innerHTML = currentValue + ' ' + metricValue[i].innerHTML;
    //                    } else {
    //                        buyButton[i].classList.remove('hide_top');
    //                        orderValue[i].classList.add('hide_bot');
    //                        wrapButton[i].classList.add('hide_opacity');
    //                    }
    //                }
    //            }
    //        })
    //    }


    //    showMenu();
    sales();
    showButtonsCart();
    
    //    changeValue();
    // calculateValue();
})
})(jQuery)