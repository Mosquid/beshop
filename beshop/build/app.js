/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./script.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./script.js":
/*!*******************!*\
  !*** ./script.js ***!
  \*******************/
/*! no static exports found */
/***/ (function(module, exports) {

/* eslint-disable no-unused-vars */

/* eslint-disable no-undef */
(function ($) {
  document.addEventListener('DOMContentLoaded', function () {
    $('.sidenav').sidenav();
    $('.modal').modal();
    $('select').formSelect();
    var breakpoint = window.matchMedia('(min-width: 768px)');

    var homepageSlider = function homepageSlider() {
      if (breakpoint.matches) {
        var desktopSlider = new Swiper('.sales_header', {
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
      } else {
        var mobileSlider = new Swiper('.sales_header', {
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
      var searchButton = document.querySelector('.open-search');
      var searchWidget = document.querySelector('.widget_search');
      var searchInput = document.querySelector('.widget_search .search-field');

      searchButton.onclick = function (event) {
        event.stopPropagation();
        searchWidget.classList.toggle('active');
        searchInput.focus();
      };

      document.addEventListener('click', function (event) {
        if (searchWidget.classList.contains('active')) {
          var isClickInside = searchInput.contains(event.target);

          if (!isClickInside) {
            searchWidget.classList.toggle('active');
          }
        }
      });
    }

    desktopSearch();

    function showButtonsCart() {
      var item = document.querySelectorAll('.product');
      var buyButton = document.querySelectorAll('.category_order_button');
      var wrap = document.querySelector('.woocommerce');
      var orderValue = document.querySelectorAll('.category_order_capacity');
      var minusButton = document.querySelectorAll('.category_order_select_minus');
      var plusButton = document.querySelectorAll('.category_order_select_plus');
      var productNumber = document.querySelectorAll('.item_number');
      wrap.addEventListener('click', function (e) {
        for (var i = 0; i < item.length; i++) {
          if (e.target.classList.contains('category_order_button') && e.target === buyButton[i]) {
            buyButton[i].classList.add('hide_top');
            orderValue[i].classList.remove('hide_bot');
            jQuery(plusButton[i]).trigger('click');
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

    var categoriesView = localStorage.getItem('categoriesView');
    var classes = ['list', 'list-pic', 'grid', 'big-grid'];
    $('.category_list > div').addClass(categoriesView);
    $('.categories-switcher').on('click', function () {
      $('.category_list > div').each(function () {
        this.className = classes[($.inArray(this.className, classes) + 1) % classes.length];
        localStorage.setItem('categoriesView', this.className);
      });
    });

    function showCurrentValue() {
      var orderCapacity = document.querySelectorAll('.category_order_capacity');
      var buyButton = document.querySelectorAll('.category_order_button');
      var productNumber = document.querySelectorAll('.item_number');

      for (var i = 0; i < productNumber.length; i++) {
        if (productNumber[i].value !== 0) {
          buyButton[i].classList.add('hide_top');
          orderCapacity[i].classList.remove('hide_bot');
        }
      }
    }

    showButtonsCart();
  });
})(jQuery);

/***/ })

/******/ });
//# sourceMappingURL=app.js.map