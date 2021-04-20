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

  function init() {
    console.log('init wcagHelper');
    removeNavIds();
  }

  window.addEventListener('DOMContentLoaded', init);
}

export default wcagHelper;