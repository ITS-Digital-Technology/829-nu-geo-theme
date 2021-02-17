<?php

class acf_field_icon_picker extends acf_field {
	
	function __construct() {
		$this->name = 'icon-picker';
		$this->label = __( 'Icon Picker', 'acf-icon-picker' );
		$this->category = 'relational';
		$this->defaults = array(
			'allow_null' => true,
		);

		$this->icon_font = apply_filters( 'acf/icon-picker-path', get_template_directory() . '/css/iconfont.css' );
		$this->icon_font_uri = apply_filters( 'acf/icon-picker-uri', get_template_directory_uri() . '/css/iconfont.css' );

		$this->settings = [
            'version' => '1.0.0',
		];

		// do not delete!
    	parent::__construct();
	}


	/**
	 * Get Choices
	 * @param  string $format  Return format. Either php or js.
	 * @return mixes           PHP array or json_encoded array.
	 */
	public function get_choices( $format = 'php' ) {

		$icon_css = file_get_contents( $this->icon_font );

		$classes = [];
		if ( preg_match_all( '/\.([a-zA-Z-]+)[:]{1,2}before/', $icon_css, $matches ) ) {
			foreach ( $matches[1] as $icon_class ) {
				$classes[] = sanitize_text_field( $icon_class );
			}
		}

		$result = [];
		$result[] = [
			'id'     => '',
			'name'   => '',
			'html'   => '<span style="opacity: .7">Select an icon</span>',
			'text'   => 'Select an icon',
			'hidden' => true,
		];

		foreach ( $classes as $icon_class ) {

			// Strip the icon class and generate a title based on the class name.
			$icon_array = explode( '-', $icon_class );
			array_shift( $icon_array );
			$icon_array = array_map( 'ucfirst', $icon_array );
			$icon_text = implode( ' ', $icon_array );

			$result[] = [
				'id'   => $icon_class,
				'name' => $icon_text,
				'html' => '<i class="' . esc_attr( $icon_class ) . '"></i> ' . esc_html( $icon_text ),
				'text' => $icon_class
			];
		}

		usort( $result, array( $this, 'compare' ) );

		if ( 'js' === $format ) {
			return json_encode( $result );
		} else {
			return $result;
		}

	}

	/**
	 * Compare icon values.
	 *
	 * @param string $a The first item.
	 * @param string $b The second item.
	 * @return int The comparison integer.
	 */
	function compare( $a, $b ) {
		return strcmp( $a['name'], $b['name'] );
	}
	
	function render_field( $field ) {
		?>

		<select class="icon-picker-select" name="<?php echo esc_attr( $field['name'] ); ?>">

			<?php if ( ! empty( $field['value'] ) ) : ?>
				<option value="<?php echo esc_attr($field['value']) ?>" selected><?php echo $field['value']; ?></option>
			<?php endif; ?>

			<?php foreach ( $this->get_choices() as $choice ) : ?>
				<option value="<?php echo esc_attr( $choice['id'] ) ?>"><i class="<?php echo esc_attr( $choice['id'] ) ?>"></i><?php echo esc_html( $choice['id'] ) ?></option>
			<?php endforeach; ?>

		</select>

		<?php
	}

	function input_admin_enqueue_scripts() {
		$version = $this->settings['version'];

		// register & include CSS
		wp_enqueue_style( 'icon-picker', $this->icon_font_uri, [ 'acf-input' ], $version );
		wp_add_inline_script( 
			'acf-input', 
			"( function( $ ) {
				var data = " . $this->get_choices( 'js' ) . ";

				var renderSelect2 = function( target ) {

					$( target ).select2({
						data: data,
						escapeMarkup: function(markup) {
							return markup;
						},
						templateResult: function(data) {
							return data.html;
						},
						templateSelection: function(data) {
							return data.html;
						}
					});

				}

				// When acf has loaded
				acf.add_action('ready', function( el ) {
					renderSelect2( '.icon-picker-select:not(:hidden)' );
				});

				// When an flexible content field is appended
				acf.add_action('append', function( el ) {
					renderSelect2( $( el ).find('.icon-picker-select:not(:hidden)') );
				});
			} ( jQuery ) );", 
			'after' 
		);
	}

}


// create field
new acf_field_icon_picker();
