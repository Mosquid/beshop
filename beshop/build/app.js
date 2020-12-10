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

(function ($) {
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
    } // eslint-disable-next-line no-unused-vars


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

    sales();
    showButtonsCart();
  });
})(jQuery);

/***/ })

/******/ });
//# sourceMappingURL=app.js.map