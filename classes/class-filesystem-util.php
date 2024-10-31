<?php
namespace OMNIPRESS;

if ( defined( 'ABSPATH' ) === false ) {
	exit;
}

if ( ! class_exists( 'OMNIPRESS\FileSystemUtil' ) ) {
	/**
	 * File System Utility class.
	 *
	 * @since v1.4.2
	 *
	 * @author omnipressteam.
	 *
	 * @copyright (c) 2024
	 */
	class FileSystemUtil {

		/**
		 * Initialize the WordPress filesystem.
		 *
		 * @return WP_Filesystem_Direct|\WP_Error Filesystem object or \WP_Error on failure.
		 */
		private static function init_filesystem() {
			global $wp_filesystem;

			require_once ABSPATH . 'wp-admin/includes/file.php';

			if ( ! \WP_Filesystem() ) {
				return new \WP_Error( 'filesystem_error', __( 'Failed to initialize the filesystem.', 'text-domain' ) );
			}

			return $wp_filesystem;
		}

		/**
		 * Read the content of a file.
		 *
		 * @param string $file_path Path to the file.
		 * @return string|\WP_Error File content or \WP_Error on failure.
		 */
		public static function read_file( $file_path ) {
			$wp_filesystem = self::init_filesystem();

			if ( is_wp_error( $wp_filesystem ) ) {
				return $wp_filesystem;
			}

			if ( ! $wp_filesystem->exists( $file_path ) ) {
				return new \WP_Error( 'file_not_found', __( 'File not found.', 'text-domain' ) );
			}

			$content = $wp_filesystem->get_contents( $file_path );

			if ( false === $content ) {
				return new \WP_Error( 'file_read_error', __( 'Error reading file.', 'text-domain' ) );
			}

			return $content;
		}

		/**
		 * Write content to a file.
		 *
		 * @param string $file_path Path to the file.
		 * @param string $content Content to write.
		 * @return true|\WP_Error True on success, WP_Error on failure.
		 */
		public static function write_file( $file_path, $content ) {
			$wp_filesystem = self::init_filesystem();
			if ( is_wp_error( $wp_filesystem ) ) {
				return $wp_filesystem;
			}

			$result = $wp_filesystem->put_contents( $file_path, $content, FS_CHMOD_FILE );

			if ( false === $result ) {
				return new \WP_Error( 'file_write_error', __( 'Error writing file.', 'text-domain' ) );
			}

			return true;
		}

		/**
		 * Delete a file.
		 *
		 * @param string $file_path Path to the file.
		 * @return true|\WP_Error True on success, \WP_Error on failure.
		 */
		public static function delete_file( $file_path ) {
			$wp_filesystem = self::init_filesystem();
			if ( is_wp_error( $wp_filesystem ) ) {
				return $wp_filesystem;
			}

			if ( ! $wp_filesystem->exists( $file_path ) ) {
				return new \WP_Error( 'file_not_found', __( 'File not found.', 'text-domain' ) );
			}

			$result = $wp_filesystem->delete( $file_path );

			if ( false === $result ) {
				return new \WP_Error( 'file_delete_error', __( 'Error deleting file.', 'text-domain' ) );
			}

			return true;
		}

		/**
		 * Check the mime type of a file.
		 *
		 * @param string $file_path Path to the file.
		 * @return string|\WP_Error Mime type or \WP_Error on failure.
		 */
		public static function get_file_mime_type( $file_path ) {
			$wp_filesystem = self::init_filesystem();
			if ( is_wp_error( $wp_filesystem ) ) {
				return $wp_filesystem;
			}

			if ( ! $wp_filesystem->exists( $file_path ) ) {
				return new \WP_Error( 'file_not_found', __( 'File not found.', 'text-domain' ) );
			}

			$mime_type = wp_check_filetype( $file_path );

			if ( false === $mime_type['type'] ) {
				return new \WP_Error( 'mime_type_error', __( 'Error determining mime type.', 'text-domain' ) );
			}

			return $mime_type['type'];
		}

		/**
		 * Handle file upload.
		 *
		 * @param array  $file Array containing 'name', 'type', 'tmp_name', 'error', and 'size'.
		 * @param string $destination_path Path to save the uploaded file.
		 * @return string|\WP_Error Path to the uploaded file or \WP_Error on failure.
		 */
		public static function handle_file_upload( $file, $destination_path ) {
			if ( ! isset( $file['tmp_name'] ) || ! is_uploaded_file( $file['tmp_name'] ) ) {
				return new \WP_Error( 'upload_error', __( 'Invalid file upload.', 'text-domain' ) );
			}

			$wp_filesystem = self::init_filesystem();
			if ( is_wp_error( $wp_filesystem ) ) {
				return $wp_filesystem;
			}

			$upload_dir  = wp_upload_dir();
			$destination = trailingslashit( $upload_dir['basedir'] ) . $destination_path;

			// Move the uploaded file
			if ( ! $wp_filesystem->move( $file['tmp_name'], $destination ) ) {
				return new \WP_Error( 'upload_move_error', __( 'Error moving uploaded file.', 'text-domain' ) );
			}

			return $destination;
		}
	}
}
