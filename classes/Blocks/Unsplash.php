<?php

namespace AdvancedGutenbergBlocks\Blocks;

use AdvancedGutenbergBlocks\Helpers\Consts;
use AdvancedGutenbergBlocks\Services\Blocks;

class Unsplash {

  public function run() {

		// Register Hooks
		add_action( 'enqueue_block_editor_assets', array( $this, 'editor_assets' ) );

		// Register Block in the plugin settings page
		$args = array(
			'icon' => 'dashicons-camera',
			'category' => 'apis',
			'preview_image' => Consts::get_url() . 'admin/img/blocks/unslplash.jpg',
			'description' => __( "Find beautiful pictures from the best free photos stock", 'advanced-gutenberg-blocks' ),
			'options_callback' => array( $this, 'settings' ),
			'require' => __('This block requires an API key'),
			'available' => false,
		);

		Blocks::register_block( 'advanced-gutenberg-blocks/unsplash', __( 'Unsplash', 'advanced-gutenberg-blocks' ), $args );

		// Register settings
		Blocks::register_setting( 'advanced-gutenberg-blocks-unsplash-api-key' );
  }

	public function settings() {
		echo '
			<div class="AGB-form__setting">
				<div class="AGB-form__label">
					<label for="advanced-gutenberg-blocks-unsplash-api-key"> ' . __( 'Api Key', 'advanced-gutenberg-blocks' ) . '</label>
				</div>

				<div class="AGB-form__field">
					<input type="text" name="advanced-gutenberg-blocks-unsplash-api-key" placeholder="' . __( 'Insert your Unsplash API Key here', 'advanced-gutenberg-blocks' ) . '" value="' . get_option( 'advanced-gutenberg-blocks-unsplash-api-key' ) . '">
				</div>
			</div>

			<p class="AGB-form__help">' . __( 'The API key is mandatory, you can create one on the <a href="https://www.opengraph.io/" target="_blank">OpenGraph.io API service</a>. ' ) . '</p>
		';
	}

	public function editor_assets() {
		$api_key = get_option( 'advanced-gutenberg-blocks-unsplash-api-key' );

		$data = array();

		if ( $api_key == "" ) {
			$data['error'] = 'noApiKey';
		} else {
			$data['apiKey'] = $api_key;
		}

		wp_localize_script(
			Consts::BLOCKS_SCRIPT,
			'advancedGutenbergBlocksUnsplash',
			$data
		);

	}
}
