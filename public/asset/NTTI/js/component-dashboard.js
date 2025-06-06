/*!
 * DEV: HENG SYNOEUN v1.0.0
 */
'use strict';

function _interopDefaultLegacy(e) { return e && typeof e === 'object' && 'default' in e ? e : { 'default': e }; }

var $__default = /*#__PURE__*/_interopDefaultLegacy($);

// Start CardWidget
var NAME$d = 'CardWidget';
var DATA_KEY$d = 'lte.cardwidget';
var EVENT_KEY$6 = "." + DATA_KEY$d;
var JQUERY_NO_CONFLICT$d = $__default["default"].fn[NAME$d];
var EVENT_EXPANDED$3 = "expanded" + EVENT_KEY$6;
var EVENT_COLLAPSED$4 = "collapsed" + EVENT_KEY$6;
var EVENT_MAXIMIZED = "maximized" + EVENT_KEY$6;
var EVENT_MINIMIZED = "minimized" + EVENT_KEY$6;
var EVENT_REMOVED$1 = "removed" + EVENT_KEY$6;
var CLASS_NAME_CARD = 'card';
var CLASS_NAME_COLLAPSED$1 = 'collapsed-card';
var CLASS_NAME_COLLAPSING = 'collapsing-card';
var CLASS_NAME_EXPANDING = 'expanding-card';
var CLASS_NAME_WAS_COLLAPSED = 'was-collapsed';
var CLASS_NAME_MAXIMIZED = 'maximized-card';
var SELECTOR_DATA_REMOVE = '[data-card-widget="remove"]';
var SELECTOR_DATA_COLLAPSE = '[data-card-widget="collapse"]';
var SELECTOR_DATA_MAXIMIZE = '[data-card-widget="maximize"]';
var SELECTOR_CARD = "." + CLASS_NAME_CARD;
var SELECTOR_CARD_HEADER = '.card-header';
var SELECTOR_CARD_BODY = '.card-body';
var SELECTOR_CARD_FOOTER = '.card-footer';
var Default$b = {
    animationSpeed: 'normal',
    collapseTrigger: SELECTOR_DATA_COLLAPSE,
    removeTrigger: SELECTOR_DATA_REMOVE,
    maximizeTrigger: SELECTOR_DATA_MAXIMIZE,
    collapseIcon: 'mdi-chevron-down',
    expandIcon: 'mdi-chevron-up',
    maximizeIcon: 'fa-expand',
    minimizeIcon: 'fa-compress'
};

var CardWidget = /*#__PURE__*/function () {
    function CardWidget(element, settings) {
        this._element = element;
        this._parent = element.parents(SELECTOR_CARD).first();

        if (element.hasClass(CLASS_NAME_CARD)) {
            this._parent = element;
        }

        this._settings = $__default["default"].extend({}, Default$b, settings);
    }

    var _proto = CardWidget.prototype;

    _proto.collapse = function collapse() {
        var _this = this;

        this._parent.addClass(CLASS_NAME_COLLAPSING).children(SELECTOR_CARD_BODY + ", " + SELECTOR_CARD_FOOTER).slideUp(this._settings.animationSpeed, function () {
            _this._parent.addClass(CLASS_NAME_COLLAPSED$1).removeClass(CLASS_NAME_COLLAPSING);
        });

        this._parent.find("> " + SELECTOR_CARD_HEADER + " " + this._settings.collapseTrigger + " ." + this._settings.collapseIcon).addClass(this._settings.expandIcon).removeClass(this._settings.collapseIcon);

        this._element.trigger($__default["default"].Event(EVENT_COLLAPSED$4), this._parent);
        this._parent.find('i').toggleClass(this._settings.collapseIcon + ' ' + this._settings.expandIcon);
    };

    _proto.expand = function expand() {
        var _this2 = this;

        this._parent.addClass(CLASS_NAME_EXPANDING).children(SELECTOR_CARD_BODY + ", " + SELECTOR_CARD_FOOTER).slideDown(this._settings.animationSpeed, function () {
            _this2._parent.removeClass(CLASS_NAME_COLLAPSED$1).removeClass(CLASS_NAME_EXPANDING);
        });

        this._parent.find("> " + SELECTOR_CARD_HEADER + " " + this._settings.collapseTrigger + " ." + this._settings.expandIcon).addClass(this._settings.collapseIcon).removeClass(this._settings.expandIcon);

        this._element.trigger($__default["default"].Event(EVENT_EXPANDED$3), this._parent);
        this._parent.find('i').toggleClass(this._settings.expandIcon + ' ' + this._settings.collapseIcon);
    };

    _proto.remove = function remove() {
        this._parent.slideUp();

        this._element.trigger($__default["default"].Event(EVENT_REMOVED$1), this._parent);
    };

    _proto.toggle = function toggle() {
        if (this._parent.hasClass(CLASS_NAME_COLLAPSED$1)) {
            this.expand();
            return;
        }

        this.collapse();
    };

    _proto.maximize = function maximize() {
        this._parent.find(this._settings.maximizeTrigger + " ." + this._settings.maximizeIcon).addClass(this._settings.minimizeIcon).removeClass(this._settings.maximizeIcon);

        this._parent.css({
            height: this._parent.height(),
            width: this._parent.width(),
            transition: 'all .15s'
        }).delay(150).queue(function () {
            var $element = $__default["default"](this);
            $element.addClass(CLASS_NAME_MAXIMIZED);
            $__default["default"]('html').addClass(CLASS_NAME_MAXIMIZED);

            if ($element.hasClass(CLASS_NAME_COLLAPSED$1)) {
                $element.addClass(CLASS_NAME_WAS_COLLAPSED);
            }

            $element.dequeue();
        });

        this._element.trigger($__default["default"].Event(EVENT_MAXIMIZED), this._parent);
    };

    _proto.minimize = function minimize() {
        this._parent.find(this._settings.maximizeTrigger + " ." + this._settings.minimizeIcon).addClass(this._settings.maximizeIcon).removeClass(this._settings.minimizeIcon);

        this._parent.css('cssText', "height: " + this._parent[0].style.height + " !important; width: " + this._parent[0].style.width + " !important; transition: all .15s;").delay(10).queue(function () {
            var $element = $__default["default"](this);
            $element.removeClass(CLASS_NAME_MAXIMIZED);
            $__default["default"]('html').removeClass(CLASS_NAME_MAXIMIZED);
            $element.css({
                height: 'inherit',
                width: 'inherit'
            });

            if ($element.hasClass(CLASS_NAME_WAS_COLLAPSED)) {
                $element.removeClass(CLASS_NAME_WAS_COLLAPSED);
            }

            $element.dequeue();
        });

        this._element.trigger($__default["default"].Event(EVENT_MINIMIZED), this._parent);
    };

    _proto.toggleMaximize = function toggleMaximize() {
        if (this._parent.hasClass(CLASS_NAME_MAXIMIZED)) {
            this.minimize();
            return;
        }
        this.maximize();
    };

    _proto._init = function _init(card) {
        var _this3 = this;

        this._parent = card;
        $__default["default"](this).find(this._settings.collapseTrigger).click(function () {
            _this3.toggle();
        });
        $__default["default"](this).find(this._settings.maximizeTrigger).click(function () {
            _this3.toggleMaximize();
        });
        $__default["default"](this).find(this._settings.removeTrigger).click(function () {
            _this3.remove();
        });
    };

    CardWidget._jQueryInterface = function _jQueryInterface(config) {
        var data = $__default["default"](this).data(DATA_KEY$d);

        var _options = $__default["default"].extend({}, Default$b, $__default["default"](this).data());

        if (!data) {
            data = new CardWidget($__default["default"](this), _options);
            $__default["default"](this).data(DATA_KEY$d, typeof config === 'string' ? data : config);
        }

        if (typeof config === 'string' && /collapse|expand|remove|toggle|maximize|minimize|toggleMaximize/.test(config)) {
            data[config]();
        } else if (typeof config === 'object') {
            data._init($__default["default"](this));
        }
    };

    return CardWidget;
}();
/**
* Data API
* ====================================================
*/


$__default["default"](document).on('click', SELECTOR_DATA_COLLAPSE, function (event) {
    if (event) {
        event.preventDefault();
    }

    CardWidget._jQueryInterface.call($__default["default"](this), 'toggle');
});
$__default["default"](document).on('click', SELECTOR_DATA_REMOVE, function (event) {
    if (event) {
        event.preventDefault();
    }

    CardWidget._jQueryInterface.call($__default["default"](this), 'remove');
});
$__default["default"](document).on('click', SELECTOR_DATA_MAXIMIZE, function (event) {
    if (event) {
        event.preventDefault();
    }

    CardWidget._jQueryInterface.call($__default["default"](this), 'toggleMaximize');
});
/**
 * jQuery API
 * ====================================================
 */

$__default["default"].fn[NAME$d] = CardWidget._jQueryInterface;
$__default["default"].fn[NAME$d].Constructor = CardWidget;

$__default["default"].fn[NAME$d].noConflict = function () {
    $__default["default"].fn[NAME$d] = JQUERY_NO_CONFLICT$d;
    return CardWidget._jQueryInterface;
};
// End CardWidget

const _CardWidget = CardWidget;
export { _CardWidget as CardWidget };

