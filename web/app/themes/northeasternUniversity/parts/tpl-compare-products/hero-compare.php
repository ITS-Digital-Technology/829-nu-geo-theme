<?php
$description = get_field( 'cp_description' );
?>
<section class="hero-compare">
    <div class="hero-compare__wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="hero-compare__title"><?php the_title(); ?></h1>
                <?php if ( ! empty( $description ) ) : ?>
                    <p class="hero-compare__description leadparagraph"><?php echo $description; ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>