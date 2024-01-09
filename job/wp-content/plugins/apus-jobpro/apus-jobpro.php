<?php
/**
 * Plugin Name: Apus Jobpro
 * Plugin URI: http://apusthemes.com/booking/
 * Description: Apus Jobpro is a plugin for Jobpro listing theme
 * Version: 1.0.0
 * Author: ApusTheme
 * Author URI: http://apusthemes.com
 * Requires at least: 3.8
 * Tested up to: 4.1
 *
 * Text Domain: apus-jobpro
 * Domain Path: /languages/
 *
 * @package apus-jobpro
 * @category Plugins
 * @author ApusTheme
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists("ApusJobpro") ){
	
	final class ApusJobpro{

		private static $instance;

		public static function getInstance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ApusJobpro ) ) {
				self::$instance = new ApusJobpro;
				self::$instance->setup_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

				self::$instance->includes();
			}

			return self::$instance;
		}

		/**
		 *
		 */
		public function setup_constants(){

			// Plugin Folder Path
			if ( ! defined( 'APUSJOBPRO_PLUGIN_DIR' ) ) {
				define( 'APUSJOBPRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			}

			// Plugin Folder URL
			if ( ! defined( 'APUSJOBPRO_PLUGIN_URL' ) ) {
				define( 'APUSJOBPRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
			}

			// Plugin Root File
			if ( ! defined( 'APUSJOBPRO_PLUGIN_FILE' ) ) {
				define( 'APUSJOBPRO_PLUGIN_FILE', __FILE__ );
			}
		}

		public function includes() {
			require_once APUSJOBPRO_PLUGIN_DIR . 'inc/class-template-loader.php';
			require_once APUSJOBPRO_PLUGIN_DIR . 'inc/taxonomies/class-taxonomy-job-manager-regions.php';
			require_once APUSJOBPRO_PLUGIN_DIR . 'inc/taxonomies/class-taxonomy-job-manager-tags.php';
		}

		/**
		 *
		 */
		public function load_textdomain() {
			// Set filter for ApusJobpro's languages directory
			$lang_dir = dirname( plugin_basename( APUSJOBPRO_PLUGIN_FILE ) ) . '/languages/';
			$lang_dir = apply_filters( 'apusjobpro_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale', get_locale(), 'apus-jobpro' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'apus-jobpro', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/apus-jobpro/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/apus-jobpro folder
				load_textdomain( 'apus-jobpro', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/apus-jobpro/languages/ folder
				load_textdomain( 'apus-jobpro', $mofile_local );
			} else {
				// Load the default language files
				load_plugin_textdomain( 'apus-jobpro', false, $lang_dir );
			}
		}
	}
}

function ApusJobpro() {
	return ApusJobpro::getInstance();
}

ApusJobpro();
