var Navigation = (function() {
  var Constructor = function($ele, _options) {
    var defaults = {
      speed: 600,
      section_selector: '.section',
      resize: true,
      updateMenu: true,
      active_class: 'active',
      goToTop_selector: ".goToTop",
      offsetSection: 0,
      afterGoToSection: function() {
      },
      onLastSection: function() {
      },
      leaveLastSection: function() {
      },
      flecha_selector: null,
      fullPage: false
    };
    this.options = $.extend(defaults, _options);
    this.$ele = $ele;
    this.pageSections = $(this.options.section_selector).map(function() {
      return $(this).attr("name");
    });
    this.setDataPositions();

    this.dom = {
      list_items: $ele.children()
    };
    this.setFullPage(this.options.fullPage);
    var speed = this.options.speed;
    $(this.options.goToTop_selector).on('click', $.proxy(this.goToPos, this));
    if (this.options.resize) {
      $(window).on('resize', $.proxy(this.reset, this));
    }
    if (this.options.updateMenu) {
      $(window).on('scroll', $.proxy(this.updateMenu, this));    
    }
    ;
    if (this.options.flecha_selector) {
      $(this.options.flecha_selector).click($.proxy(function() {
        this.goToNextSection();
      }, this));
    }
    this.$ele.on('click', 'a', $.proxy(this.goToSection, this));
  };

  Constructor.prototype = {
    setFullPage: function(value) {
      this.options.fullPage = value;
      if (value === false) {
        this.$ele.on('click', 'a', $.proxy(this.goToSection, this));
      } else {
        this.$ele.off('click', 'a', $.proxy(this.goToSection, this));
      }
    },
    goToSection: function(event) {
      this.goTo($(event.target).attr('href'));
      this.options.afterGoToSection.call(this);
    },
    goTo: function(hash) {
      if (!this.options.fullPage) {
        
        var position = $(".section[name='" + hash.substring(1) + "-name']").data('position');
        this.goToPos(position - this.options.offsetSection);
      } else {
        $.fn.fullpage.moveTo(hash.substring(1), 0);
      }      
    },
    goToNextSection: function(hash) {
      if (this.options.fullPage) {
        var curSection = this.getCurrentSection();
        if (curSection === "escribenos") {
          $.fn.fullpage.moveSectionUp();
        } else {
          $.fn.fullpage.moveSectionDown();
        }
      } else {
        var offset = this.options.offsetSection;
        var curSectionArray = this.pageSections.map(function() {
          if ($(".section[name='" + this + "']").data('position') <= ($(window).scrollTop() + offset+1)) {
            return this;
          } else {
            return null;
          }
        });
        var curSection = this.pageSections[curSectionArray.length] || "hero";
        this.goTo("#" + curSection.toString());
      }

    },
    goToPos: function(position) {
      if (isNaN(position)) {
        position = 0
      }
      $('html, body').animate({scrollTop: position || 0}, this.options.speed);
      setTimeout(function(){$(document).trigger("scroll")}, this.options.speed);
    },
    setDataPositions: function() {
      var parent = this;
      $(this.options.section_selector).each(function() {
        if (parent.options.fullPage) {
          var offset = $(this).offset().top - (parseInt($("#fullpage").css("top"), 10));
        } else {

          var offset = ($(this).offset().top);
        }
        $(this).data("position", offset);
      });
    },
    getCurrentSection: function() {

      var offset = this.options.offsetSection;
      if (this.options.fullPage) {
        var scrollTop = -(parseInt($("#fullpage").css("top"), 10));
      } else {
        var scrollTop = $(window).scrollTop();
      }
      var curSectionArray = this.pageSections.map(function() {
        if ($(".section[name='" + this + "']").data('position') <= (scrollTop + offset+1)) {
          return this;
        } else {
          return null;
        }
      });
      var curSection = curSectionArray[curSectionArray.length - 1] || "inicio";
      if (curSectionArray.length == this.pageSections.length) {
        this.options.onLastSection.call(this);
      } else {
        this.options.leaveLastSection.call(this);
      }
      return curSection.toString();
    },
    reset: function() {
      setTimeout($.proxy(function() {
        this.setDataPositions();
      }, this), 1000);
    },
    updateMenu: function(event) {
      var section_id = this.getCurrentSection(),
          $button = this.dom.list_items.find('a[href=#' + section_id + ']'),
          $li = $button.parent();
        this.$ele.children().removeClass(this.options.active_class);
        $li.addClass(this.options.active_class);
    },
    destroy: function() {
      this.$ele.off('click', 'a', $.proxy(this.goToSection, this));
      if (this.options.resize) {
        $(window).off('resize', $.proxy(this.reset, this));
      }
    }
  };

  return Constructor;

})();

jQuery.fn.navigation = function(options) {
  return new Navigation($(this), options);
}

