<?php

if ( ! class_exists( 'Cptts_Shortcodes' ) ):

    class Cptts_Shortcodes {

        /**
         * Map
         *
         * @var array
         */
        private $shortcodes = array(
            'custom_button' => 'button',
            'blockquote_func' => 'blockquote',
            'leadparagraph_func' => 'leadparagraph',
            'highlight_func' => 'highlight',
            'hook_func' => 'hook',
            'full_width_func' => 'full_width',
            'content_images_func' => 'content_image',
            'full_width_image_func' => 'full_width_image',
            'accordion_wrapper_func' => 'accordion_wrapper',
            'accordion_func' => 'accordion',
            'current_year_func' => 'current_year',
            'columns_func' => 'columns',
            'clear_func'    => 'clear',
            'tabs_func'     => 'tabs',
            'tab_func'      => 'tab'
        );

        function get_shortcode_theme_part($part, $vars = array(), $content = '') {
            ob_start();
            get_theme_part($part, [
                'vars' => $vars,
                'content' => $content
            ]);
            return ob_get_clean();
        }

        function custom_button( $atts, $content ) {
            extract(shortcode_atts( array(
                'href'  => '#',
                'style' => 'primary',
                'color' => 'normal',
                'alignment' => 'left',
                'target' => '_self'
            ), $atts ));

            $class = 'c-btn c-btn-' . $style . ' c-btn-color-' . $color;

            $icon_html = '';
            if ($style === 'secondary') {
                $src = get_template_directory() . '/images/icons/link-arrow.svg';
                $icon = file_get_contents($src);
                $icon_html = "<span class='c-btn-icon'>$icon</span>";
            }

            return "<div class='c-btn-wrapper align-$alignment'><a href='$href' class='$class' target='$target'><span>$content</span>$icon_html</a></div>";
        }

        function blockquote_func( $atts, $content = null ) {
            shortcode_atts( array(
                'author' => ''
            ), $atts );

            return '<blockquote class="alternate"><cite>'.$content.'</cite><span class="author">'.$atts['author'].'</span></blockquote>';
        }
        function leadparagraph_func( $atts, $content = null ) {
            shortcode_atts( array(
            ), $atts );

            return '<p class="leadparagraph">'.$content.'</p>';
        }
        function highlight_func( $atts, $content = null ) {
            shortcode_atts( array(
            ), $atts );

            return '<span class="highlight-text">'.$content.'</span>';
        }
        function hook_func( $atts, $content = null ) {
            shortcode_atts( array(
                'id' => '#id'
            ), $atts );

            return '<div id="' . $atts['id'] . '"></div>';
        }
        function full_width_func( $atts, $content ) {
            return $this->get_shortcode_theme_part('page/shortcode/page-fullwidth', $atts, $content);
        }
        function content_images_func( $atts, $content ) {
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
        function full_width_image_func($atts, $content) {
            return $this->get_shortcode_theme_part('page/shortcode/page-fullwidth-image', $atts, $content);
        }
        function accordion_wrapper_func($atts, $content) {
            return $this->get_shortcode_theme_part('page/shortcode/page-accordion-wrapper', $atts, $content);
        }
        function accordion_func($atts, $content) {
            return $this->get_shortcode_theme_part('page/shortcode/page-accordion-single', $atts, $content);
        }
        function columns_func($atts, $content) {
            shortcode_atts( array(
                'desktop'  => '10',
                'tablet'  => '10',
                'mobile'  => '12'
            ), $atts );
            return $this->get_shortcode_theme_part('page/shortcode/page-columns', $atts, $content);
        }
        function current_year_func( $atts ) {
            return date('Y');
        }
        function clear_func() {
            return "<div class='clearfix'></div>";
        }

        function tabs_func( $atts, $content = null ) {
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

        function tab_func( $atts, $content = null ) {
            shortcode_atts( array(
                'id' => ''
            ), $atts );

            $html = '<div id="tabs-' . $atts['id'] . '">';
            $html .= do_shortcode( $content );
            $html .= '</div>';

            return $html;
        }

        /**
         * INTERNAL CLASS FUNCTIONALITY
         */

        /**
         * Cptts_Shortcodes constructor.
         */
        function __construct() {
            add_action( 'init', array( $this, 'create_shorcodes' ) );
        }

        /**
         * Registers all shortcodes defined in $this->shortcodes.
         */
        public function create_shorcodes() {
            foreach ( $this->shortcodes as $func => $name ) {
                add_shortcode( $name, array( $this, $func ) );
            }
        }
    }

    new Cptts_Shortcodes();

endif;
