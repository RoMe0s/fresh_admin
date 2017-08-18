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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

$(document).ready(function () {

    $(document).on("click", "[data-generate-name]", function (e) {

        var $form = $(this).closest('form'),
            field = $(this).attr('data-generate-name'),
            $field = $form.find('[name="' + field + '"]');

        $.ajax({
            type: "POST",
            url: "/admin/generate-name",
            data: $form.serialize()
        }).done(function (response) {

            if (response.length) {

                $field.val(response);
            }
        });
    });

    $(document).on("click", "[data-generate]", function (e) {

        var from = $(this).attr('data-from').split(','),
            _val = [],
            $to = $(document).find('[name="' + $(this).attr('data-to') + '"]');

        for (var i = 0; i < from.length; i++) {

            _val.push($(document).find('[name="' + from[i] + '"]').val());
        }

        $.ajax({
            type: "GET",
            url: "/admin/slug-string",
            data: {
                value: _val
            }
        }).done(function (response) {

            if (response.length) {

                $to.val(response);
            }
        });
    });

    $('select[name="sizes[]"][multiple]').select2({
        maximumSelectionLength: 8
    });

    $('select[name="colors[]"][multiple]').select2({
        maximumSelectionLength: 7
    });

    $(document).find(".has-error").each(function () {

        var $tab = $(this).closest("div.tab-pane"),
            id = $tab.attr('id'),
            $href = $('a[href="#' + id + '"]').closest('li');

        $href.css('border-top-color', 'red');
    });
});

document.querySelectorAll('[data-status]').forEach(function (el, index) {

    var status = el.getAttribute('data-status'),
        new_class = "",
        row = el.closest("tr");

    if (status === "canceled") {

        new_class = "bg-danger";
    } else if (status === "done") {

        new_class = "bg-success";
    } else if (status === 'in_work') {

        new_class = 'bg-info';
    }

    try {
        row.classList.add(new_class);
    } catch (err) {}
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);