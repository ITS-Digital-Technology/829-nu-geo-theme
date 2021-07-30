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
		this.searchOverlay.on("keydown", this.handleTabbing.bind(this));
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
			this.searchTrigger.focus();
		}
	}

	hideOutsideClick(e) {
		if (this.searchOverlay.hasClass('active')) {
			if (!this.searchOverlay.is(e.target) && this.searchOverlay.has(e.target).length === 0 && !this.searchTriggerCloseDesktop.is(e.target)) {
				this.closeSearchOverlay();
			}
		}
	}

	wrapFocusToLast() {
		this.searchTriggerCloseDesktop.focus();
	}

	wrapFocusToFirst() {
		$("#search").focus();
	}

	isSearchInput(element) {
		if(element) {
			return ($(element).attr("type") && $(element).attr("type") === $("#search").attr("type"));
		}
		return false;
	}

	isCloseButton(element) {
		if(element) {
			return ($(element).attr("class") && $(element).attr("class") === this.searchTriggerCloseDesktop.attr("class"));
		}
		return false;
	}

	handleTabbing(e) {
		if(this.searchOverlay.hasClass('active') && e.shiftKey && e.keyCode == 9) {
			if(this.isSearchInput(document.activeElement)) {
				e.preventDefault();
				this.wrapFocusToLast();
				return false;
			}
		} else if (this.searchOverlay.hasClass('active') && this.isCloseButton(document.activeElement) && e.keyCode == 9) {
			e.preventDefault();
			this.wrapFocusToFirst();
			return false;
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