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

  function init() {
    console.log('init wcagHelper');
    removeNavIds();
    topLevelNav();
  }

  window.addEventListener('DOMContentLoaded', init);
}

export default wcagHelper;