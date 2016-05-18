(function ($) {
    $.fn.pageScroller = function (options) {
        var settings = $.extend({
            'position': 'left-middle',

            'scroll-up-speed': 800,
            'scroll-down-speed': 800,

            'animation-hideshow': false,
            'animation-hideshow-duration-show': 200,
            'animation-hideshow-duration-hide': 500,
            'animation-hideshow-visible-part': 20,
            'animation-hideshow-block-scroll-in-padding': 0
        }, options);

        return this.each(function () {
            $(this).css({
                'position': 'fixed'
            });

            switch (settings['position']) {
                case 'left-top':
                    $(this).addClass('left-top');
                    break;

                case 'right-top':
                    $(this).addClass('right-top');
                    break;

                case 'left-middle':
                    $(this).addClass('left-middle');
                    break;

                case 'right-middle':
                    $(this).addClass('right-middle');
                    break;

                case 'left-bottom':
                    $(this).addClass('left-bottom');
                    break;

                case 'right-bottom':
                default:
                    $(this).addClass('right-bottom');
                    break;
            }

            if (settings['animation-hideshow']) {
                $(this).addClass('animation-hideshow');

                switch (settings['position']) {
                    case 'left-top':
                    case 'left-middle':
                    case 'left-bottom':
                        $(this).animate({'left': settings['animation-hideshow-visible-part'] - $(this).outerWidth()}, settings['animation-hideshow-duration-hide']).hover(
                            function () {
                                $(this).stop().animate({'left': 0 + settings['animation-hideshow-distance-to-page']}, settings['animation-hideshow-duration-show']);
                            }, function () {
                                $(this).stop().animate({'left': settings['animation-hideshow-visible-part'] - $(this).outerWidth()}, settings['animation-hideshow-duration-hide']);
                            }
                        );
                        break;
                    case 'right-top':
                    case 'right-middle':
                    case 'right-bottom':
                    default:
                        $(this).animate({'right': settings['animation-hideshow-visible-part'] - $(this).outerWidth()}, settings['animation-hideshow-duration-hide']).hover(
                            function () {
                                $(this).stop().animate({'right': 0 + settings['animation-hideshow-distance-to-page']}, settings['animation-hideshow-duration-show']);
                            }, function () {
                                $(this).stop().animate({'right': settings['animation-hideshow-visible-part'] - $(this).outerWidth()}, settings['animation-hideshow-duration-hide']);
                            }
                        );
                        break;
                }
            }

            $(this).on("click", ".page-scroller-up-btn", function (e) {
                $('html,body').animate({
                    scrollTop: 0
                }, settings['scroll-up-speed']);
                e.preventDefault();
            }).on("click", ".page-scroller-down-btn", function (e) {
                $('html,body').animate({
                    scrollTop: $(document).outerHeight()
                }, settings['scroll-down-speed']);
                e.preventDefault();
            });
        });
    };
})(jQuery);