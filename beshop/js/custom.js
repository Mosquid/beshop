var ADDING_TO_CART = "adding-to-cart"

function debounce(func, wait, immediate) {
  var timeout
  return function () {
    var context = this,
      args = arguments
    var later = function () {
      timeout = null
      if (!immediate) func.apply(context, args)
    }
    var callNow = immediate && !timeout
    clearTimeout(timeout)
    timeout = setTimeout(later, wait)
    if (callNow) func.apply(context, args)
  }
}

function updateCartPodcutQty() {
  var actionBtn = this.find(".add_to_cart_button")

  if (!actionBtn || !actionBtn.length) return

  var qty = actionBtn[0].dataset.quantity
  var productId = actionBtn[0].dataset.product_id

  if (!qty || !productId) return

  this.addClass(ADDING_TO_CART)
  actionBtn.trigger("click")
}

function updateQtyNodes(nodes, cart) {
  if (!nodes.length) return

  var IDs = []

  if (cart.length) {
    var $cartProducts = cart.find(".remove_from_cart_button")

    if ($cartProducts.length) {
      IDs = $cartProducts.toArray().map(function (item) {
        return item.dataset.product_id
      })
    }
  }

  nodes.each(function (_, node) {
    try {
      var $node = jQuery(node)
      var productId = $node.find(".ajax_add_to_cart").get(0).dataset.product_id
      var $qty = $node.find(".item_number")
      if (!IDs.includes(productId)) $qty.val(0)
    } catch (error) {
      return false
    }
  })
}

function setInitialBtnStatus(node) {
  const HIDE_BOT = "hide_bot"
  const HIDE_TOP = "hide_top"
  const qtyInput = node.find(".item_number")
  const addToStore = node.find(".ajax_add_to_cart")
  const cartButton = node.find(".category_order_button")
  const capacity = node.find(".category_order_capacity")
  const qty = parseInt(qtyInput.val())

  if (!qty) return

  try {
    addToStore[0].dataset.quantity = qty
    capacity.removeClass(HIDE_BOT)
    cartButton.addClass(HIDE_TOP)
  } catch (error) {
    console.log("[Failed setting initial qty]")
  }
}

function handleItemAdded(_, frags) {
  jQuery(`.${ADDING_TO_CART}`).removeClass(ADDING_TO_CART)
  const cartCount = jQuery('.cart_button span')
  let total = 0
  
  try {
    const cart = Object.values(frags)[0]
    const items = jQuery(cart).find('li')
    items.each(function(_, item) {
      const qtyText = item.querySelector('.quantity').textContent.split(' ')
      total += parseInt(qtyText[0])
    })
    cartCount.text(total)
  } catch (error) {}
}

;(function ($) {
  function initQtyFields() {
    var nodes = $(
      ".products .product .category_order, .single-product .category_order"
    )

    $(document.body).on("removed_from_cart", function () {
      var cart = $("ul.woocommerce-mini-cart")
      updateQtyNodes(nodes, cart)
    })

    $(document.body).on("added_to_cart", handleItemAdded)

    if (!nodes.length) return

    nodes.each(function (_, node) {
      var $node = $(node)
      var actionBtn = $node.find(".add_to_cart_button")
      var controls = $node.find(".qty-control")
      var qty = $node.find(".item_number")

      setInitialBtnStatus($node)

      controls.on("click", function (event) {
        var $control = $(event.target)
        var action = $control.data("action")
        var addition = action === "plus" ? 1 : -1
        var qtyVal = parseInt(qty.val())
        var newVal = Math.max(0, qtyVal + addition)

        qty.val(newVal)
        actionBtn[0].dataset.quantity = newVal
      })

      controls.on("click", debounce(updateCartPodcutQty.bind($node), 1000))
    })
  }

  $(document).ready(initQtyFields)
})(jQuery)
