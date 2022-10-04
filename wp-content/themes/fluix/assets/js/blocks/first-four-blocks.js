(function ($) {
	$('.fls-four-blocks__more-button').on('click', function (e) {
		e.preventDefault();

		const
			$button = $(this),
			$block = $button.parent().parent();

		$block.find('.fls-four-blocks__block').removeClass('hidden');
		$button.parent().addClass('hidden');

	});
})(window.jQuery);