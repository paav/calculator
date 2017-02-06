var cap = cap || {};

cap.CalculatorAPI = function () {
    'use strict';

    /**
     * @class
     * @param {object} options
     */
    function CalculatorAPI(options) {
        this.init(options);
    };

    CalculatorAPI.DEFAULTS = {
        calculate: {
            url: '/calculations',
            method: 'POST'
        }
    };

    CalculatorAPI.prototype = {
        init: function (options) {
            this.options = $.extend({}, CalculatorAPI.DEFAULTS, options);
        },

        /**
         * @param {string} expression
         */
        calculate: function (expression) {
            var data = { expression: expression };
            return $.ajax({
                type: this.options.calculate.method,
                url: this.options.calculate.url,
                data: data,
            });
        }
    };

    return CalculatorAPI;
}();

cap.Calculator = function () {
    'use strict';

    /**
     * @class
     * @param {HTMLElement} element
     * @param {Object} options - Configuration options.
     */
    function Calculator(element, options) {
        /**
         * @type {jQuery}
         */
        this.$el = null;

        /**
         * @type {jQuery}
         */
        this.$error = null;

        /**
         * @type {jQuery}
         */
        this.$result = null;

        /**
         * @type {Array}
         */
        this.errors = [];

        /**
         * @type {cap.CalculatorAPI}
         */
        this.api = null;

        this.init(element, options);
    };

    Calculator.DEFAULTS = {
        selectors: {
            template: '#calculator-template',
            expression: '.calculator__expression',
            error: '.calculator__error',
            result: '.calculator__result'
        },
        errors: {
            match: 'Неверное значение.',
            zeroDivision: 'На ноль делить нельзя.'
        }
    };

    Calculator.prototype = {
        /**
         * @param {HTMLElement} element
         * @param {Object} options
         */
        init: function (element, options) {
            this.options = $.extend({}, Calculator.DEFAULTS, options);
            var template = _.template($(this.options.selectors.template).html());
            this.$el = $(template());
            $(element).replaceWith(this.$el);
            this.$error = $(this.options.selectors.error);
            this.$result = $(this.options.selectors.result);
            this.api = new cap.CalculatorAPI();
            this.bindEvents();
        },

        bindEvents: function () {
            this.$el.on('submit', this.onSubmit.bind(this));
        },

        onSubmit: function (event) {
            event.preventDefault();
            var expression = $(this.options.selectors.expression).val();
            var isValid = this.validateExpression(expression);
            this.renderErrors(this.errors);
            if (isValid) {
                this.calculate(expression);
            }
            this.renderResult('');
            return isValid;
        },

        /**
         * @param {string} value
         */
        validateExpression: function (value) {
            var re = /\s*(-?\d+|-?\d*\.\d+)\s*([-+*\/])\s*(\d*\.\d+|\d+)\s*/;
            this.errors = [];
            var matches = value.match(re);

            if (!matches) {
                this.errors.push(this.options.errors.match);
                return false;
            } else if (matches[3] == 0) {
                this.errors.push(this.options.errors.zeroDivision);
                return false
            }
            return true;
        },

        /**
         * @param {Array} errors
         */
        renderErrors: function (errors) {
            if (errors.length !== 0) {
                this.$error.html(errors[0]);
                this.$error.parent().addClass('has-error');
            } else {
                this.$error.html('');
                this.$error.parent().removeClass('has-error');
            }
        },

        /**
         * @param {string} result
         */
        renderResult: function (result) {
            this.$result.val(result);
        },

        /**
         * @param {string} expression
         */
        calculate: function (expression) {
            var that = this;
            this.api.calculate(expression)
                .done(function (response) {
                    that.renderResult(response.result);
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    alert('Произошла ошибка.\n\nОбратитесь в службу технической поддержки.\n\nтел. 555-555');
                    console.log(jqXHR.status + ' (' + errorThrown + ')\n\n'
                        + 'Try to enable debug mode in web/index.php file.');
                });
        }
    };

    return Calculator;
}(jQuery);

$.fn.calculator = function(options) {
    return this.each(function () {
        new cap.Calculator(this, options);
    });
};