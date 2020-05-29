<?php
/**
 * Google Fonts Selector Control for the Customizer
 *
 * @version 1.0.0
 * @package WordPress
 * @subpackage Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'FT_Google_Fonts_Selector_Control' ) ) {
	require_once __DIR__ . '/helper.php';

	class FT_Google_Fonts_Selector_Control extends WP_Customize_Control {
		/**
		 * Control Type
		 *
		 * @var string
		 */
		public $type = 'ft-google-fonts-selector';

		/**
		 * Fonts Theme Option
		 */
		public $fonts_theme_option = '';

		/**
		 * Enqueue scripts/styles.
		 *
		 * @since 1.0.0
		 */
		 public function enqueue() {
			$file_path = __DIR__;
			$url_path = str_replace( $_SERVER['DOCUMENT_ROOT'], '', $file_path );
			wp_enqueue_script( 'ft-google-fonts-selector', $url_path . '/js/ft-google-fonts-selector.js', array(), rand(), true );
			wp_localize_script( 'ft-google-fonts-selector', 'weightNames', array(
				'100' => __( 'Thin', 'ft-customizer-controls' ),
				'200' => __( 'Extra Light', 'ft-customizer-controls' ),
				'300' => __( 'Light', 'ft-customizer-controls' ),
				'400' => __( 'Normal', 'ft-customizer-controls' ),
				'500' => __( 'Medium', 'ft-customizer-controls' ),
				'600' => __( 'Semi Bold', 'ft-customizer-controls' ),
				'700' => __( 'Bold', 'ft-customizer-controls' ),
				'800' => __( 'Extra Bold', 'ft-customizer-controls' ),
				'900' => __( 'Black', 'ft-customizer-controls' ),
				'950' => __( 'Extra Black', 'ft-customizer-controls' )
			));
		}

		/**
		 * Render the control's content
		 */
		public function render_content() {
			$current_font = json_decode( urldecode( $this->value() ), true );
			$available_fonts = $this->get_fonts_array( get_theme_mod( $this->fonts_theme_option, '' ) );
			if ( ! is_array( $current_font ) ) {
				$current_font = array(
					'family' => 'Open Sans',
					'weight' => '400'
				);
			}
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input
					class="ft-google-fonts-selector"
					type="hidden"
					value="<?php echo esc_attr( wp_json_encode( $current_font ) ); ?>"
					<?php $this->link(); ?>
				>
				<span class="customize-control-title"><?php _e( 'Font Family', 'ft-customizer-controls' ); ?></span>
				<select class="ft-google-fonts-selector__family">
					<?php
					foreach ( $available_fonts as $font ) {
						$selected = ( $current_font['family'] === $font['family'] ) ? selected( 1, 1, false ) : '';
						echo '<option value="' . esc_attr( $font['family'] ) . '"' . esc_html( $selected ) . ' data-weights="' . implode( ',', $font['weights'] ) . '">' . esc_html( $font['family'] ) . '</option>';
					}
					?>
				</select>
				<span class="customize-control-title"><?php _e( 'Font Weight', 'ft-customizer-controls' ); ?></span>
				<select class="ft-google-fonts-selector__weight">
					<?php
					foreach ( $available_fonts as $font ) {
						if ( $current_font['family'] !== $font['family'] ) {
							continue;
						}
						foreach( $font['weights'] as $weight ) {
							$selected = ( $current_font['weight'] === $weight ) ? selected( 1, 1, false ) : '';
							echo '<option value="' . esc_attr( $weight ) . '"' . esc_html( $selected ) . '>' . esc_html( $this->get_weight_name( $weight ) ) . '</option>';
						}
					}
					?>
				</select>
				<?php if ( ! empty( $this->description ) ) : ?>
					<br />
					<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>
			</label>
			<?php
		}

		function get_fonts_array( $fonts ) {
			$fonts_array = array();
			$lines = explode( "\n", $fonts );
			foreach ( $lines as $line ) {
				$font_name = FTCustomizerControls\Helper\get_string_between( $line, 'family=', '&display=' );
				$font_weights = array( '400' );
				if ( 0 !== strpos( $font_name, ':wght@' ) ) {
					$font_name = substr( $font_name, 0, strpos( $font_name, ':wght@' ) );
					$font_weights = FTCustomizerControls\Helper\get_string_between( $line, ':wght@', '&display=' );
					$font_weights = explode( ';', $font_weights );
				}
				$font_name = urldecode( $font_name );
				$fonts_array[] = array(
					'family' => $font_name,
					'weights' => $font_weights
				);
			}
			return $fonts_array;
		}

		function get_weight_name( $weight ) {
			$weight_names = array(
				'100' => __( 'Thin', 'ft-customizer-controls' ),
				'200' => __( 'Extra Light', 'ft-customizer-controls' ),
				'300' => __( 'Light', 'ft-customizer-controls' ),
				'400' => __( 'Normal', 'ft-customizer-controls' ),
				'500' => __( 'Medium', 'ft-customizer-controls' ),
				'600' => __( 'Semi Bold', 'ft-customizer-controls' ),
				'700' => __( 'Bold', 'ft-customizer-controls' ),
				'800' => __( 'Extra Bold', 'ft-customizer-controls' ),
				'900' => __( 'Black', 'ft-customizer-controls' ),
				'950' => __( 'Extra Black', 'ft-customizer-controls' )
			);
			return $weight_names[ $weight ];
		}
	}
}