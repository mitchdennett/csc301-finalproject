/*! lg-fullscreen - v1.0.1 - 2016-09-30
* http://sachinchoolur.github.io/lightGallery
* Copyright (c) 2016 Sachin N; Licensed GPLv3 */

(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
      // AMD. Register as an anonymous module unless amdModuleId is set
      define(['jquery'], function (a0) {
        return (factory(a0));
      });
    } else if (typeof exports === 'object') {
      // Node. Does not work with strict CommonJS, but
      // only CommonJS-like environments that support module.exports,
      // like Node.
      module.exports = factory(require('jquery'));
    } else {
      factory(jQuery);
    }
  }(this, function ($) {
  
  (function() {
  
      'use strict';
  
      var defaults = {
        addcart: true
      };
  
      var AddCart = function(element) {
  
          // get lightGallery core plugin data
          this.core = $(element).data('lightGallery');
  
          this.$el = $(element);
  
          // extend module defalut settings with lightGallery core settings
          this.core.s = $.extend({}, defaults, this.core.s);
  
          this.init();
  
          return this;
      };
  
      AddCart.prototype.init = function() {
          var fullScreen = '';
          fullScreen = '<span class="lg-icon"><i class="nc-icon nc-cart-simple"></i></span>';
            this.core.$outer.find('.lg-toolbar').append(fullScreen);
            this.addtocart();
      };
  
      
      // https://developer.mozilla.org/en-US/docs/Web/Guide/API/DOM/Using_full_screen_mode
      AddCart.prototype.addtocart = function() {
          var _this = this;
  
          this.core.$outer.find('.nc-cart-simple').on('click.lg', function() {
            alert('adding to cart');
          });
  
      };
  
      AddCart.prototype.destroy = function() {
  
          // exit from fullscreen if activated

      };
  
      $.fn.lightGallery.modules.addcart = AddCart;
  
  })();
  
  }));
  