<?php
/**
 * Textarea Control for the Customizer
 *
 * @version 1.0.0
 * @package WordPress
 * @subpackage Customizer
 */

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'FT_Textarea_Control' ) ) {

	/**
	 * FT_Textarea_Control class
	 *
	 * @extends WP_Customize_Control
	 */
	class FT_Textarea_Control extends WP_Customize_Control {

		/**
		 * Control Type
		 *
		 * @var string
		 */
		public $type = 'ft-textarea';

		/**
		 * Render the control's content
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
					<?php echo esc_textarea( $this->value() ); ?>
				</textarea>
				<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>
			</label>
			<?php
		}

	}
}
