(function($) {
	$.fn.pageScroller = function(options) {
		var settings = $.extend({
			'position': 'left-middle',
			'block-visible': '30',
			'animation-speed-out': 500,
			'animation-speed-in': 200,
		}, options);

		return this.each(function() {
			$(this).css({
				'position': 'fixed'
			});

			switch (settings['position']) {
				case 'left-top':
					$(this).css({
						'top': '0', 'left': 0
					});
					break
				case 'left-middle':
					$(this).css({
						'top': '50%', 'left': 0, 'margin-top': -($(this).height() / 2)
					}).animate({'left': settings['block-visible'] - $(this).outerWidth()}, settings['animation-speed-out']).hover(
							function() {
								$(this).stop().animate({'left': 0}, settings['animation-speed-in']);
							}, function() {
								$(this).stop().animate({'left': settings['block-visible'] - $(this).outerWidth()}, settings['animation-speed-out']);
						}
							);
					break
				case 'left-bottom':
					$(this).css({
						'bottom': '0', 'left': 0
					});
					break
				case 'right-top':
					$(this).css({
						'top': '0', 'right': 0
					});
					break
				case 'right-middle':
					$(this).css({
						'top': '50%', 'right': 0, 'margin-top': -($(this).height() / 2)
					});
					break
				case 'right-bottom':
					$(this).css({
						'bottom': '50px', 'right': '25px'
					});
					break
			}

			$(this).on("click", ".page-scroller-up-btn", function(e) {
				$('html,body').animate({
					scrollTop: 0
				}, 800);
				e.preventDefault();
			}).on("click", ".page-scroller-down-btn", function(e) {
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