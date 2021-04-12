import screenLock from '../__utils/lockScroll';
const $ = jQuery.noConflict();

class Search {
	constructor() {
		this.header = $('.main-header');
		this.searchTrigger = this.header.find('.main-header__search-button');
		this.searchTriggerCloseDesktop = this.header.find('.search-bar__close');
		this.searchOverlay = this.header.find('.search-bar');
		this.searchForm = $('.search-filter');
		this.searchInput = this.searchForm.find('input[type="search"]');
		this.searchSubmit = this.searchForm.find('.search-form__submit');
		this.searchDelete = this.searchForm.find('.search-form__close');
	}

	init() {
		this.searchTrigger.on('click', this.toggleSearchOverlay.bind(this));
		this.searchTriggerCloseDesktop.on('click', this.closeSearchOverlay.bind(this));
		this.searchInput.on('focus', this.inputFocus);
		this.searchSubmit.on('click', this.submitInput.bind(this));
		this.searchDelete.on('click', this.deleteInput.bind(this));
	}

	inputFocus() {
		$(this).parent().parent().removeClass('filled').addClass('typing');
	}

	submitInput() {
		this.searchInput.blur().parent().removeClass('typing');

		if (this.searchInput.val() !== '') {
			this.searchInput.parent().parent().addClass('filled');
		}
	}

	deleteInput(e) {
		e.preventDefault();
		this.searchInput.val('').parent().parent().removeClass('filled');
		this.searchInput.focus();
	}

	toggleSearchOverlay() {
		if (!this.searchOverlay.hasClass('active')) {
			this.searchOverlay.addClass('active').find('input[type="search"]').focus();
			screenLock.lock();
		} else {
			this.closeSearchOverlay();
		}
	}

	closeSearchOverlay() {
		if (this.searchOverlay.hasClass('active')) {
			this.searchOverlay.removeClass('active').find('input[type="search"]').blur();
			screenLock.unlock();
		}
	}

	hideOutsideClick(e) {
		if (this.searchOverlay.hasClass('active')) {
			if (!this.searchOverlay.is(e.target) && this.searchOverlay.has(e.target).length === 0 && !this.searchTriggerCloseDesktop.is(e.target)) {
				this.closeSearchOverlay();
			}
		}
	}

	keyPressDispatcher(e) {
		if (e.keyCode == 27 && this.searchOverlay.hasClass('active')) {
			this.closeSearchOverlay();
		}
	}

	keyDown(e) {
		this.keyPressDispatcher(e);
	}

}



export default new Search;