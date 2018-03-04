<?php

namespace GutenbergBlocks\WP;

defined('ABSPATH') or die('Cheatin&#8217; uh?');

use GutenbergBlocks\Helpers\Consts;

/**
 * Admin enqueue styles, scripts and menu declaration
 *
 * @author Maximebj
 * @version 1.0.0
 * @since 1.0.0
 */

class Admin {

	public function register_hooks() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
		add_action('admin_menu', array( $this, 'add_admin_menu'));
	}

	public function enqueue_assets($hook) {

		if($hook != 'toplevel_page_gutenberg-blocks') {
			return;
		}

		wp_enqueue_style(
			Consts::PLUGIN_NAME,
			Consts::get_url().'admin/css/gutenberg-blocks-admin.css',
			array(),
			Consts::VERSION,
			'all'
		);

		wp_enqueue_script(
			Consts::PLUGIN_NAME.'-settings',
			Consts::get_url().'admin/js/gutenberg-blocks-settings.js',
			array('jquery'),
			Consts::VERSION,
			false
		);
	}

	public function add_admin_menu() {

		// For now in Settings.php
	}

}