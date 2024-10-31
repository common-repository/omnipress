<?php

namespace Omnipress\classes;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

if ( ! class_exists( '\Omnipress\classes\OPFileSystem' ) ) {
	class OPFileSystem {
		private static $instance;

		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {
			$this->initialize_filesystem();
		}


		public function initialize_filesystem() {
			global $wp_filesystem;

			require_once ABSPATH . 'wp-admin/includes/file.php';

			WP_Filesystem();

			return $this;
		}

		public function file_exists( $file_path ) {
			global $wp_filesystem;
			return $wp_filesystem->exists( $file_path );
		}

		// Method to create and write to a file.
		public function create_and_write_file( $file_path, $file_content, $replace = true ) {
			global $wp_filesystem;

			if ( $replace ) {

				return $wp_filesystem->put_contents( $file_path, $file_content, FS_CHMOD_FILE );
			} else {

				return $wp_filesystem->append( $file_path, $file_content );

			}
		}
		public function remove_file( $file_path ) {
			global $wp_filesystem;
			return $wp_filesystem->delete( $file_path );
		}

		// Method to remove a directory
		public function remove_directory( $dir_path ) {
			global $wp_filesystem;

			if ( $this->file_exists( $dir_path ) && $wp_filesystem->is_dir( $dir_path ) ) {
				if ( $wp_filesystem->delete( $dir_path, true ) ) { // true allows recursive deletion
					return 'Directory deleted successfully.';
				} else {
					return 'Failed to delete the directory.';
				}
			} else {
				return 'Directory does not exist.';
			}
		}

		public function get_contents( $file_path ) {
			global $wp_filesystem;
			return $wp_filesystem->get_contents( $file_path );
		}

		public function get_block_frontend_styles_path() {
			return OMNIPRESS_PATH . 'assets/css/blocks';
		}

		public function create_dir( $directory_path ) {
			global $wp_filesystem;

			return $wp_filesystem->mkdir( $directory_path, FS_CHMOD_DIR );
		}
	}

}
