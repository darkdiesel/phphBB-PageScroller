(function ($) {
    $.fn.pageScroller = function (options) {
        var settings = $.extend({
            'position': 'left-middle',
            'block-visible': '30',
            'animation-speed-out': 500,
            'animation-speed-in': 200,
        }, options);

        return this.each(function () {
            $(this).css({
                'position': 'fixed'
            });

            switch (settings['position']) {
                case 'right-top':
                    $(this).addClass('right-top');
                    break;

                case 'left-top':
                    $(this).addClass('left-top');
                    break;

                case 'right-middle':
                    $(this).addClass('right-middle');
                    break;

                case 'left-middle':
                    $(this).addClass('left-middle');
                    break;

                case 'right-bottom':
                    $(this).addClass('right-bottom');
                    break;

                case 'left-bottom':
                    $(this).addClass('left-bottom');
                    break;
            }

            $(this).on("click", ".page-scroller-up-btn", function (e) {
                $('html,body').animate({
                    scrollTop: 0
                }, 800);
                e.preventDefault();
            }).on("click", ".page-scroller-down-btn", function (e) {
                $('html,body').animate({
                    scrollTop: $(document).outerHeight()
                }, 800);
                e.preventDefault();
            });
        });

        function hoverLeft() {

        }
    };
})(jQuery);