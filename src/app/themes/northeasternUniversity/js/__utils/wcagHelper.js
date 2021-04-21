function wcagHelper() {
  function removeNavIds() {
    const menuItems = document.querySelectorAll('.main-header__mobile li, .main-header__right li');

    if (menuItems) {
      menuItems.forEach(menuItem => {
        const id = menuItem.getAttribute('id');

        if(id) {
          menuItem.setAttribute('id', '');
        }
      });
    }
  }

  function topLevelNav() {
    const menuItems = document.querySelectorAll('.main-header__mobile ul > li > a, .main-header__right ul > li > a');

    if(menuItems) {
      menuItems.forEach(menuItem => {
        if (menuItem.getAttribute('href') === '#') {
          menuItem.removeAttribute('href');
          menuItem.classList.add('menu-trigger');
        }
      });
    }
  }

  function addToAny() {
    const socialLinks = document.querySelectorAll('.a2a_kit a:not(.addtoany_share)');
    const shareLink = document.querySelector('.addtoany_share');

    if(socialLinks) {
      socialLinks.forEach(socialLink => {
        const title = socialLink.getAttribute('title');

        if (title) {
          socialLink.setAttribute('aria-label', `Connect on ${title}`);
        }
      });
    }
    
    if(shareLink) {
      shareLink.setAttribute('aria-label', 'Share this page');
    }
  }

  function tribesFilterBar() {
    const formFields = document.querySelectorAll('form.tribe-filter-bar__form input[type="checkbox"]');
    const fieldSets = document.querySelectorAll('fieldset.tribe-filter-bar-c-filter__filters-fieldset');
    const headingTitle = document.querySelectorAll('h1');
    const pageTitle = headingTitle[0] ? headingTitle[0].textContent : '';

    if (formFields) {
      formFields.forEach(formField => {
        const label = formField.nextElementSibling.textContent.trim();

        if (label) {
          formField.setAttribute('aria-label', label);
        }
      });
    }

    if(fieldSets) {
      fieldSets.forEach(fieldSet => {
        const innerElement = fieldSet.querySelector('.tribe-filter-bar-c-filter__filter-fields');
        let i = 0;

        if (innerElement) {
          innerElement.setAttribute('role', 'group');
          innerElement.setAttribute('aria-label', `Event filters for ${pageTitle} ${i}`);
        }

        i++;
      });
    }
  }

  function init() {
    console.log('init wcagHelper');
    removeNavIds();
    topLevelNav();
    addToAny();
    tribesFilterBar();
  }

  window.addEventListener('DOMContentLoaded', init);
}

export default wcagHelper;