const cookieBar = {
    cookies: document.getElementById('cookie-bar'),

    init() {
        if (this.cookies) {
            this.cookies.querySelector('.cookie-bar__close').onclick = () => {
                this.cookies.remove();
            };

            this.cookies.querySelector('.cookie-bar__accept').onclick = () => {
                document.cookie = 'northeasternUniversityCookiesAccepted=1;max-age=31536000';
                this.cookies.remove();
            };
        }
    }
}

export default cookieBar;