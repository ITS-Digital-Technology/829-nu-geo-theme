<?php
/**
 * Theme shortcodes
 *
 * Please follow the same format for registering new shortcodes.
 */

namespace BaseTheme\Shortcodes;

// Button
function button( $atts, $content ) {
    extract(shortcode_atts( array(
        'href'  => '#',
        'style' => 'primary',
        'color' => 'normal',
        'alignment' => 'left',
        'target' => '_self'
    ), $atts ));

    $class = 'c-btn c-btn-' . $style . ' c-btn-color-' . $color;

    return "<div class='c-btn-wrapper text-$alignment'><a href='$href' class='$class' target='$target'><span>$content</span></a></div>";
}
add_shortcode( 'button', 'BaseTheme\Shortcodes\button' );

// Group buttons
function group_buttons( $atts, $content ) {
    return "<div class='c-btn-group'>" . do_shortcode($content) ."</div>";
}
add_shortcode( 'group_buttons', 'BaseTheme\Shortcodes\group_buttons' );

// Blockquote
function blockquote( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'author' => '',
		),
		$atts
	);
	return '<blockquote class="alternate"><p>' . $content . '</p><footer>' . $atts['author'] . '</footer></blockquote>';
}
add_shortcode( 'blockquote', 'BaseTheme\Shortcodes\blockquote' );

// Lead Paragraph
function leadparagraph( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'alignment' => ''
    ), $atts );

    $align = $atts['alignment'];

    if(!empty($align)) {
        $align = ' text-'.$align;
    }

    return '<p class="leadparagraph'.$align.'">'.$content.'</p>';
}
add_shortcode( 'leadparagraph', 'BaseTheme\Shortcodes\leadparagraph' );

// Highlight Text
function highlight( $atts, $content = null ) {
    shortcode_atts( array(
    ), $atts );

    return '<span class="highlight-text">'.$content.'</span>';
}
add_shortcode( 'highlight', 'BaseTheme\Shortcodes\highlight' );

// Dropcap
function dropcap_func( $atts, $content = null ) {
    shortcode_atts( array(
    ), $atts );

    return '<span class="dropcap">'.$content.'</span>';
}
add_shortcode( 'dropcap', 'BaseTheme\Shortcodes\dropcap' );

// Hook (Anchor)
function hook( $atts, $content = null ) {
    shortcode_atts( array(
        'id' => '#id'
    ), $atts );

    return '<div id="' . $atts['id'] . '"></div>';
}
add_shortcode( 'hook', 'BaseTheme\Shortcodes\hook' );

// Content Images
function content_image( $atts, $content ) {
    extract(shortcode_atts( array(
        'align'  => 'none',
        'spacing'  => 'normal',
    ), $atts ));

    $images_class = 'content-image content-image__align-' . $align . ' spacing-' . $spacing;
    $images_count = substr_count($content, '<img');
    if($images_count > 1)
        $images_class .= ' content-image-multiple';
    return '<div class="' . $images_class . '">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'content_image', 'BaseTheme\Shortcodes\content_image' );

// Full width image.
function full_width_image($atts, $content) {
    ob_start();
    break_grid('close');
    ?>

    <div class="page-fullwidth-image">
        <figure class="page-fullwidth-image__wrapper">
            <?php echo do_shortcode($content); ?>
        </figure>
    </div>

    <?php
    break_grid('open');
    $output = ob_get_contents();
    ob_end_clean();

	return $output;
}
add_shortcode( 'full_width_image', 'BaseTheme\Shortcodes\full_width_image' );

// Accordion Wrapper
function accordion_wrapper($atts, $content) {
    ob_start();
    break_grid('close');
    ?>

    <div class="page-accordion">
        <div class="container">
            <div class="row">
                <div class="<?php echo \ContentBlock::get_block_size_class(); ?>">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    break_grid('open');
    $output = ob_get_contents();
    ob_end_clean();

	return $output;
}
add_shortcode( 'accordion_wrapper', 'BaseTheme\Shortcodes\accordion_wrapper' );

// Accordion (Bellow)
function accordion( $atts, $content ) {
    $acc_class = 'single-accordion';
    $acc_style = '';
    if ( $atts['state'] === 'open' ) {
        $acc_class .= ' active';
        $acc_style = ' style="display:block;"';
    }

    ob_start();
    ?>

    <div class="<?php echo $acc_class; ?>">
        <div class="single-accordion__title"><h4><?php echo $atts['title']; ?><span class="single-accordion__icons"></span></h4></div>
        <div class="single-accordion__content"<?php echo $acc_style; ?>><?php echo do_shortcode($content); ?></div>
    </div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

	return $output;
}
add_shortcode( 'accordion', 'BaseTheme\Shortcodes\accordion' );

// Columns
// sets the container column width
function columns( $atts, $content ) {
	extract(
        shortcode_atts(
            array(
                'desktop' => '10',
			    'tablet'  => '10',
			    'mobile'  => '12',
            ),
            $atts
        )
    );
	$cols_desktop_class = 'col-lg-' . $atts['desktop'];
	$cols_tablet_class  = 'col-md-' . $atts['tablet'];
	$cols_mobile_class  = 'col-' . $atts['mobile'];
	$cols_class         = $cols_mobile_class . ' ' . $cols_tablet_class . ' ' . $cols_desktop_class;
	$block_class[]      = 'page-columns';
	if ( isset( $atts['spacingtop'] ) && $atts['spacingtop'] == 'true' ) {
		$block_class[] = 'columns-spacing-top';
	}
	if ( isset( $atts['spacingbottom'] ) && $atts['spacingbottom'] == 'true' ) {
        $block_class[] = 'columns-spacing-bottom';
	}
	ob_start();
	break_grid( 'close' );
	?>
    <div class="<?php echo implode( ' ', $block_class ); ?>">
		<div class="container">
			<div class="row justify-content-center">
                <div class="<?php echo $cols_class; ?>"><?php echo do_shortcode( $content ); ?></div>
            </div>
		</div>
	</div>
	<?php
	break_grid( 'open' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}
add_shortcode( 'columns', 'BaseTheme\Shortcodes\columns' );

// Current year
function current_year( $atts ) {
    return date('Y');
}
add_shortcode( 'current_year', 'BaseTheme\Shortcodes\current_year' );

// Clear (clearfix)
function clear() {
    return "<div class='clearfix'></div>";
}
add_shortcode( 'clear', 'BaseTheme\Shortcodes\clear' );

// Tabs
function tabs( $atts, $content = null ) {
    shortcode_atts( array( 'titles' => '' ), $atts );

    $titles = explode( ",", $atts['titles'] );
    $html   = '<div class="tabs">';

    $html .= '<ul>';
    for ( $i = 1; $i <= count( $titles ); $i++ ) {
        $html .= '<li><a href="#tabs-' . $i . '" rel="tabs-' . $i . '">' . trim( $titles[ $i ] ) . '</a></li>';
    }

    $html .= '</ul>';
    $html .= do_shortcode( $content );
    $html .= '</div>';

    return $html;
}
add_shortcode( 'tabs', 'BaseTheme\Shortcodes\tabs' );

// Tab
function tab_func( $atts, $content = null ) {
    shortcode_atts( array(
        'id' => ''
    ), $atts );

    $html = '<div id="tabs-' . $atts['id'] . '">';
    $html .= do_shortcode( $content );
    $html .= '</div>';

    return $html;
}
add_shortcode( 'tab', 'BaseTheme\Shortcodes\tab' );
