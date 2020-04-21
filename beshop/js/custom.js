function debounce(func, wait, immediate) {
  var timeout;
  return function () {
    var context = this,
      args = arguments;
    var later = function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

function updateCartPodcutQty() {
  var actionBtn = this.find(".add_to_cart_button");

  if (!actionBtn || !actionBtn.length) return;

  var qty = actionBtn[0].dataset.quantity;
  var productId = actionBtn[0].dataset.product_id;

  if (!qty || !productId) return;

  actionBtn.trigger("click");
}

function updateQtyNodes(nodes, cart) {
  if (!nodes.length) return;

  var IDs = [];

  if (cart.length) {
    var $cartProducts = cart.find(".remove_from_cart_button");

    if ($cartProducts.length) {
      IDs = $cartProducts.toArray().map(function (item) {
        return item.dataset.product_id;
      });
    }
  }

  nodes.each(function (_, node) {
    try {
      var $node = jQuery(node);
      var productId = $node.find(".ajax_add_to_cart").get(0).dataset.product_id;
      var $qty = $node.find(".item_number");
      if (!IDs.includes(productId)) $qty.val(0);
    } catch (error) {
      return false;
    }
  });
}

(function ($) {
  function initQtyFields() {
    var nodes = $(".products .product .category_order, .single-product .category_order");

    $(document.body).on("removed_from_cart", function () {
      var cart = $("ul.woocommerce-mini-cart");
      updateQtyNodes(nodes, cart);
    });

    if (!nodes.length) return;

    nodes.each(function (_, node) {
      var $node = $(node);
      var actionBtn = $node.find(".add_to_cart_button");
      var controls = $node.find(".qty-control");
      var qty = $node.find(".item_number");

      controls.on("click", function (event) {
        var $control = $(event.target);
        var action = $control.data("action");
        var addition = action === "plus" ? 1 : -1;
        var qtyVal = parseInt(qty.val());
        var newVal = Math.max(0, qtyVal + addition);

        qty.val(newVal);
        actionBtn[0].dataset.quantity = newVal;
      });

      controls.on("click", debounce(updateCartPodcutQty.bind($node), 1000));
    });
  }

  $(document).ready(initQtyFields);
})(jQuery);
