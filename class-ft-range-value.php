<?php
/**
 * Range Value Control for the Customizer
 *
 * @version 1.0.0
 * @package WordPress
 * @subpackage Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'FT_Range_Value_Control' ) ) {
	class FT_Range_Value_Control extends WP_Customize_Control {
		/**
		 * Control Type
		 *
		 * @var string
		 */
		public $type = 'ft-range-value';
	
		/**
		 * Enqueue scripts/styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			$file_path = __DIR__;
			$url_path = str_replace( $_SERVER['DOCUMENT_ROOT'], '', $file_path );
			wp_enqueue_script( 'ft-range-value-control', $url_path . '/js/ft-range-value-control.js', array(), rand(), true );
			wp_enqueue_style( 'ft-range-value-control', $url_path . '/css/ft-range-value-control.css', array(), rand() );
		}
	
		/**
		 * Render the control's content.
		 *
		 * @version 1.0.0
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<div class="ft-range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
					<span  style="width:100%; flex: 1 0 0; vertical-align: middle;">
						<input
							class="ft-range-slider__range"
							type="range"
							value="<?php echo esc_attr( $this->value() ); ?>"
							<?php
							$this->input_attrs();
							$this->link();
							?>
						>
						<span class="ft-range-slider__value">0</span>
					</span>
				</div>
				<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>
			</label>
			<?php
		}
	}
}