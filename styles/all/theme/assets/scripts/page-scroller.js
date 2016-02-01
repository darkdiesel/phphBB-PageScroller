(function ($) {
    $.fn.pageScroller = function (options) {
        var settings = $.extend({
            'position': 'left-middle',
            'animation-hideout': false,
            'animation-hideout-speed-in': 200,
            'animation-hideout-speed-out': 500,
            'animation-hideout-block-visible': 20,
            'animation-hideout-block-scroll-in-padding': 0,
            'scroll-top-speed': 800,
            'scroll-down-speed': 800
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

            if (settings['animation-hideout']) {
                $(this).addClass('animation-hideout');

                switch (settings['position']) {
                    case 'left-top':
                    case 'left-middle':
                    case 'left-bottom':
                        $(this).animate({'left': settings['animation-hideout-block-visible'] - $(this).outerWidth()}, settings['animation-hideout-speed-out']).hover(
                            function () {
                                $(this).stop().animate({'left': 0 + settings['animation-hideout-block-scroll-in-padding']}, settings['animation-hideout-speed-in']);
                            }, function () {
                                $(this).stop().animate({'left': settings['animation-hideout-block-visible'] - $(this).outerWidth()}, settings['animation-hideout-speed-out']);
                            }
                        );
                        break;

                    case 'right-top':
                    case 'right-middle':
                    case 'right-bottom':
                    default:
                        $(this).animate({'right': settings['animation-hideout-block-visible'] - $(this).outerWidth()}, settings['animation-hideout-speed-out']).hover(
                            function () {
                                $(this).stop().animate({'right': 0 + settings['animation-hideout-block-scroll-in-padding']}, settings['animation-hideout-speed-in']);
                            }, function () {
                                $(this).stop().animate({'right': settings['animation-hideout-block-visible'] - $(this).outerWidth()}, settings['animation-hideout-speed-out']);
                            }
                        );
                        break;
                }
            }

            $(this).on("click", ".page-scroller-up-btn", function (e) {
                $('html,body').animate({
                    scrollTop: 0
                }, settings['scroll-top-speed']);
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