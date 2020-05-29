<?php
/**
 * Google Fonts Control for the Customizer
 *
 * @version 1.0.0
 * @package WordPress
 * @subpackage Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'FT_Google_Fonts_Control' ) ) {
	class FT_Google_Fonts_Control extends WP_Customize_Control {
		/**
		 * Control Type
		 *
		 * @var string
		 */
		public $type = 'ft-google-fonts';

		/**
		 * Render the control's content
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea
					class="large-text"
					cols="20"
					rows="5"
					<?php
					$this->input_attrs();
					$this->link();
					?>
				>
					<?php echo esc_textarea( $this->value() ); ?>
				</textarea>
				<span class="description customize-control-description">
					<p>
					<?php echo wp_sprintf( '<p>%s</p><p>%s</p>', __( 'Enter the font family URL string. List each font on a new line.', 'ft-customizer-controls' ), __( 'For example, https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap', 'ft-customizer-controls' ) ); ?>
					</p>
				</span>
				<?php if ( ! empty( $this->description ) ) : ?>
					<br />
					<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>
			</label>
			<?php
		}
	}
}