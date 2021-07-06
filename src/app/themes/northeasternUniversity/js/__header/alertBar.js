import SideMenu from '../__header/SideMenu';
import MobileHeader from '../__header/MobileHeader';

const alertBar = {
    bar: document.querySelector('.alert-bar'),

    init() {
        if ( this.bar ) {
            this.bar.querySelector('.alert-bar__close').onclick = () => {
                sessionStorage.setItem('alertBarClosed', 1);
                document.querySelector('body').classList.remove('alert-bar-on');
                this.bar.remove();
                document.querySelector('#page').style.paddingTop = document.querySelector('.main-header').offsetHeight + 'px';
                SideMenu.assignHeightToSubnav();
                MobileHeader.assignHeightToNav();
            };
        }
    }
};

export default alertBar;