<?php
$text = isset($text) ? $text : get_sub_field('text');
?>
<section class="block-intro"<?php ContentBlock::the_block_id(); ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <?php echo $text;?>
            </div>
        </div>
    </div>
</section>