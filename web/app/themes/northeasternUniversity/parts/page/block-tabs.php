<?php
/**
 * Tabs block for page
 *
 * @package WordPress
 * @subpackage northeasternUniversity
 * @since northeasternUniversity 1.0
 */

$block_size = ContentBlock::get_block_size_class();
$tabs       = get_sub_field( 'tabs' );

if ( $tabs ) :
?>
<section class="block-tabs"<?php ContentBlock::the_block_id(); ?>>
	<div class="block-tabs__head">
		<div class="container">
			<div class="row">
				<div class="<?php echo $block_size; ?>">
                    <?php ContentBlock::the_block_title(); ?>
                    <div class="block-tabs__head-nav">
                        <button type="button" aria-label="Button Prev Tab" class="tabs-mobile-trigger prev-tab hide">
                            <i class="icon-chev-left"></i>
                        </button>
                        <div class="block-tabs__list">
                        <?php foreach ( $tabs as $key => $item ) : ?>
                            <button class="block-tabs__list-item<?php echo $key == 0 ? ' active' : ''; ?>" data-tab="<?php echo "#tab$key"; ?>"><?php echo $item['title']; ?></button>
                        <?php endforeach; ?>
                        </div>

                        <button type="button" aria-label="Button Next Tab" class="tabs-mobile-trigger next-tab">
                            <i class="icon-chev-right"></i>
                        </button>
                    </div>
				</div>
			</div>
		</div>
    </div>
    <div class="block-tabs__content">
    <?php foreach ( $tabs as $key => $item ) : ?>
        <div class="block-tabs__tab-content<?php echo $key == 0 ? ' active' : ''; ?>" data-tab="<?php echo "#tab$key"; ?>">
            <div class="container">
                <div class="row">
                    <div class="<?php echo $block_size; ?>">
                        <?php echo $item['content']; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</section>
<?php
endif;