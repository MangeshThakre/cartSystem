/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/myscript.js ***!
  \**********************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

$(document).ready(function () {
  $(".user-id").click(function () {
    var id = $(this).attr('data-id');
    var title = $(this).attr('data-title');
    var price = $(this).attr('data-price');
    var category = $(this).attr('data-category');
    var userId = $(this).attr('user-id');
    var link = window.location.href + 'account';

    if (userId === '') {
      window.location.replace(link);
    } else {
      $.ajax({
        type: 'POST',
        url: 'cartpost',
        data: {
          product_id: id,
          user_title: title,
          user_price: price,
          user_category: category
        },
        success: function success(data) {
          var total_item = data.total_item;
          $('.cart').html("cart: ".concat(total_item));
          alert('item added');
        }
      });
    }
  }); ////////// sub//////////////////

  $(".Psub").click(function () {
    var product_id = $(this).attr('product_id');
    $.ajax({
      type: 'POST',
      url: 'sub',
      data: {
        product_id: product_id
      },
      success: function success(data) {
        var total_item = data.total_item; // console.log(total_item);

        var count = data.count;
        var total = data.total_price;
        var dataa = data.dataaa;

        if (dataa == 1) {
          $(".count".concat(product_id)).html("count:".concat(count));
          $(".total_price".concat(product_id)).html("".concat(total));
        } else {
          $(".remove".concat(product_id)).remove();
        }

        $('.cart').html("cart: ".concat(total_item));

        if (total_item == 0) {
          $('#buy').html("<h1>Empty cart</h1>");
        } else {
          $('#buy').html("<button type=\"button\" class=\"btn btn-primary\">buy</button>");
        }
      }
    }); // count();
  }); // /////// adddd/////////

  $(".Padd").click(function () {
    var product_id = $(this).attr('product_id');
    $.ajax({
      type: 'POST',
      url: 'add',
      data: {
        product_id: product_id
      },
      success: function success(data) {
        // console.log(data);
        var total_item = data.total_item;
        var count = data.count;
        var total = data.total_price;
        $(".count".concat(product_id)).html("count:".concat(count));
        $(".total_price".concat(product_id)).html("".concat(total));
        $('.cart').html("cart: ".concat(total_item));
      }
    }); // count();
  }); //////////remove////////

  $(".remove").click(function () {
    var product_id = $(this).attr('product_id');
    $.ajax({
      type: 'POST',
      url: 'remove',
      data: {
        product_id: product_id
      },
      success: function success(data) {
        var total_item = data.total_item;
        $('.cart').html("cart: ".concat(total_item));

        if (total_item == 0) {
          $("#buy").html('<h1>Empty cart</h1>');
        } else {
          $('#cart').html("<button type=\"button\" class=\"btn btn-primary\">buy</button>");
        }

        $(".remove".concat(product_id)).remove();
      }
    });
  });
  count();

  function count() {
    $.ajax({
      type: 'GET',
      url: 'count',
      success: function success(data) {
        var total_item = data.total_item;
        $('.cart').html("cart: ".concat(total_item));

        if (total_item != 0) {
          $("#buy").html("<button type=\"button\" class=\"btn btn-primary\">buy</button>");
        } else {
          $('#buy').html("<h1>Empty cart</h1>");
        }
      }
    });
  }

  $("#buy").click(function () {
    $('.bill').show();
    $.ajax({
      type: 'GET',
      url: 'buy',
      success: function success(data) {
        var html = '';
        var cart = data.cart_data;
        var total_price = data.total_price; // console.log(total_price);

        var _iterator = _createForOfIteratorHelper(cart),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var cart_data = _step.value;
            html += "<p>title:".concat(cart_data.title, "</p>");
            html += "<p>category:".concat(cart_data.category, "</p>");
            html += "<p>price/item:<b>".concat(cart_data.price, "Rs</b> quantity:<b>").concat(cart_data.item_count, "</b></p>");
            html += "<p>price:".concat(cart_data.total_price, "</p>");
            html += "<hr>";
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }

        $('.bill').html("<div class='card  bg-dark text-white'\n          style=' position:fixed;\n          margin-top:5rem;\n          margin-left:33rem;\n          z-index:99999;\n          height:20rem;\n          width: 30rem ;\n          border-radius:5px;\n          overflow-y:scroll;\n          box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;\n          '\n          > \n          <div><h1>conform Order!</h1><hr></div>\n          <div class='container'>".concat(html, "</div>\n          \n          <div>\n          <p>total Price: <b>").concat(total_price, "Rs</b> </p>\n          <span type=\"button\" class=\"btn btn-primary\" id=\"cancel\" >cancel</span>\n          <span type=\"button\" class=\"btn btn-primary  my-3\" id=\"order\">conform order</span>\n          </div>\n          </div>"));
      }
    });
    $(document).on('click', "#cancel", function () {
      $('.bill').hide();
    });
    $(document).on('click', "#order", function () {
      alert('order successful');
      $.ajax({
        type: 'GET',
        url: 'order',
        success: function success(data) {
          $('.bill').hide();
          console.log(data);
        }
      });
    });
  });
});
/******/ })()
;