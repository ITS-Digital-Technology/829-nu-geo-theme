<?php
$news_newsletter = get_field('news_newsletter', 'options');

if( $news_newsletter ): 
    $title = $news_newsletter['news_newsletter_title'];
    $desc = $news_newsletter['news_newsletter_description'];
    $form = $news_newsletter['news_newsletter_form'];
?>

<div class="container">
    <div class="newsletter-news">

        <div class="newsletter-news__left">
        <?php if ( !empty($title) ) : ?>
            <h3 class="newsletter-news__title"><?= $title; ?></h3>
        <?php endif; ?>
        <?php if ( !empty($desc) ) : ?>
            <p class="newsletter-news__desc"><?= $desc; ?></p>
        <?php endif; ?>
        </div>

        <div class="newsletter-news__right">
        <?php if ( !empty($form) ) : ?>
            <div class="newsletter-news__right-content"><?= $form; ?></div>
        <?php endif; ?>
        </div>
        
    </div>
</div>

<?php endif;