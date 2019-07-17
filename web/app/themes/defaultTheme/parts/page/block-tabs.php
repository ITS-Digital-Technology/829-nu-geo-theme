<?php
/**
 * Tabs block for page
 *
 * @package WordPress
 * @subpackage defaultTheme
 * @since defaultTheme 1.0
 */

$block_size = ContentBlock::get_block_size_class();

$main_block_class = 'block-tabs';
$spacing_class = ContentBlock::get_block_spacing_class();
if(!empty($spacing_class))
	$main_block_class .= ' '.$spacing_class;


?><section class="<?php echo $main_block_class; ?>">
    <div class="tabs__link-list-wrapper">
        <div class="container">
            <div class="row<?php echo (get_sub_field('section_title')) ? '' : ' section-without-title'; ?>">
                <div class="<?php echo $block_size; ?>">
                    <?php ContentBlock::the_block_title(); ?>
                    <div class="tab-head-wrap">
                        <div class="tab-head">
                            <ul class="tabs__link-list">
                            <?php
                                $iter = 0;
                                while(have_rows('tabs')): the_row();
                                    $el_class = 'tabs__link';
                                    if($iter == 0){
                                        $el_class .= ' active';
                                    }
                                    ?><li class="<?php echo $el_class; ?>"><a class="tabs_link--inner" href="<?php echo '#'.$iter++; ?>"><?php
                                        the_sub_field('title');
                                    ?></a></li><?php
                                endwhile;
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabs__tab-content-wrapper">
    <?php
        $iter = 0;
        while(have_rows('tabs')): the_row();
            $el_class = 'tabs__tab-content';
            if($iter == 0){
                $el_class .= ' active';
            }
            ?>
        <div class="<?php echo $el_class; ?>" data-tab-id="<?php echo '#'.$iter++; ?>">
            <div class="container">
                <div class="row">
                    <div class="<?php echo $block_size; ?>">
                    <?php the_sub_field('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
        endwhile;
    ?>
    </div>
</section>
