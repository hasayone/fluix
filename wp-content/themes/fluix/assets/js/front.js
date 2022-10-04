(function ($) {

	class ThemeFront {

		constructor() {

			this.setupHeaderScroll();

		}

		/**
		 * Header scroll
		 */
		setupHeaderScroll() {

			// Header
			const $header = $('.fls-main-navigation');

			if ($(window).scrollTop() > 10) {
				$header.addClass('fls-main-navigation--scrolled');
			}

			$(window).on('scroll', function () {

				let scroll = $(window).scrollTop();

				if (scroll > 10) {

					$header.addClass('fls-main-navigation--scrolled');

				} else {

					$header.removeClass('fls-main-navigation--scrolled');

				}

			});

		}
	}

	window.ThemeFront = new ThemeFront();

})(window.jQuery);