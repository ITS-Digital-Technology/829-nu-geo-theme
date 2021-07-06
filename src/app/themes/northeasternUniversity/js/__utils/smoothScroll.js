const $ = jQuery.noConflict();

function scrollFunc(e) {
	const body = $('body');
	const header = $('.main-header');

	let target = false;

	if (e) {
		e.preventDefault();
		const trigger = $(e.delegateTarget);
		target = trigger.attr('href') === '#next' ? trigger.parents('section').next() : $(trigger.attr('href'));
	} else {
		const id = window.location.hash;
		if (id) target = $(id);
	}

	if (target.length) {
		let offset = -1; // one pixel inaccuracy

		offset += header.outerHeight();

		const mt = parseInt(target.css('margin-top'), 10);
		const pt = parseInt(target.css('padding-top'), 10);
		offset += (mt > 0 && pt === 0) ? mt : 0;

		body.addClass('smooth-scroll');
		$('html, body').stop().animate({
			scrollTop: parseInt(target.offset().top - offset, 10),
		}, 600, () => {
			setTimeout(() => {
				body.removeClass('smooth-scroll')
			}, 100);
		});
	}
}

function smoothScroll() {
	$('a[href^="#"]:not([href="#"])').on('click', scrollFunc);
	setTimeout(scrollFunc, 100);
}

export default smoothScroll;
