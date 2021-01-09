/**
 * Extends WP search widget with ajax functionality
 *
 */
(function ($) {
  var HeaderSearchAjax = function (element, options) {
    var elem = $(element);
    var obj = this;

    // init
    this.init = function () {
      initHandlers();
      // appendCloseBtn();
    };

    this.results = [];
    this.resultsList = null;

    // init handlers
    var initHandlers = function () {
      $('.cart_search').on('click', function () {
        showSearch();
      });

      $('body').on('click', '.search-close', function () {
        hideSearch();
      });

      $('.search-field').on('input', function (e) {
        var searchPhrase = e.currentTarget.value;
        if (searchPhrase.length >= 3) {
          ajaxSearch(searchPhrase);
        }
      });

      elem.on('update', function () {
        setResults();
      });
    };

    var showSearch = function () {
      $('.widget_search').addClass('opened');
      $('.search-field').focus();
    }

    var hideSearch = function () {
      $('.widget_search').removeClass('opened');
      $('.search-field').val('');
      obj.resultsList.html('');
    }

    // var appendCloseBtn = function () {
    //   var closeBtn = $('<a name="close" class="search-close">Close</a>');
    //   $('.widget_search').append(closeBtn);
    // }

    var ajaxSearch = function (searchPhrase) {
      var data = {
        action: 'beshop_search',
        term: searchPhrase
      };

      // eslint-disable-next-line no-undef
      $.post(beshopAjaxProps.ajax_url, data, function (response) {
        obj.results = response;
        elem.trigger('update');
      });
    }

    var setResults = function () {
      if (obj.resultsList === null) {
        appendResultList();
      }

      var list = '';

      // eslint-disable-next-line guard-for-in
      for (var key in obj.results) {
        var item = obj.results[key];
        list += '<li><a href="' + item.url + '">' + item.name + '</a></li>';
      }

      obj.resultsList.html(list);
    }

    var appendResultList = function () {
      obj.resultsList = $('<ul class="results_list"></ul>');

      $('.widget_search').append(obj.resultsList);
    }
  };

  $.fn.headersearch = function (options) {
    var element = $(this);

    // Return early if this element already has a plugin instance
    if (element.data('headersearch'))
      return element.data('headersearch');

    // pass options to plugin constructor
    var headersearch = new HeaderSearchAjax(this, options);

    // Store plugin object in this element's data
    element.data('headersearch', headersearch);

    return headersearch;
  };
}(jQuery));

var headersearch = jQuery('.widget_search', '.main_navigation').headersearch();
headersearch.init();
