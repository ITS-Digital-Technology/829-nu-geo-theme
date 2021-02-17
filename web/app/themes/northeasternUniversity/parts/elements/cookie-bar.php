<?php
$cookie_bar_text = get_field('cookie_bar_text', 'options');

if (!empty($cookie_bar_text)) :
?>
<div class="cookie-bar" id="cookie-bar">
    <div class="container">
        <div class="row">
            <div class="cookie-bar__wrapper col-12 col-lg-8">
                <div class="cookie-bar__text">
                    <?php echo $cookie_bar_text; ?>
                </div>
            </div>
            <div class="cookie-bar__wrapper cookie-bar__wrapper--right col-12 col-lg-4">
                <button href="#" class="cookie-bar__accept c-btn c-btn-secondary">
                    <?php _e('Accept Cookies', 'northeasternUniversity'); ?>
                </button>

                <button class="cookie-bar__close" aria-label="Cookie Bar Close Button">
                    <span class="cookie-bar__icon">
                        <i class="icon-close"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    (function setCookieBar() {
        const element = document.getElementById('cookie-bar');
        if (document.cookie.split(';').some((item) => item.includes('northeasternUniversityCookiesAccepted=1'))) {
            element.parentNode.removeChild(element);
        }
    })();
</script>
<?php
endif;