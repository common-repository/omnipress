<?php

namespace Omnipress;

defined( 'ABSPATH' ) || exit;

/**
 * Register template's type for blocks supports.
 *
 * @since 1.2.0
 */
class BlockTemplates {
	/**
	 * @var string
	 *
	 * Set post type params
	 */
	private $prefix = 'op';
	public string $type;
	public string $name;
	public string $singular_name;
	public string $slug;
	private string $plugin_slug = 'omnipress';
	private string $menu        = 'omnipress-templates';


	/**
	 * Type constructor.
	 *
	 * When register template types.
	 */
	public function __construct( string $singular, string $plural, string $slug ) {
		$this->singular_name = $singular;
		$this->name          = $plural;
		$this->slug          = $this->prefix . '-' . strtolower( $slug );
		$this->type          = $this->slug;

		/**
		 * Register template type just before register omnipress blocks.
		 */
		add_action( 'init', array( $this, 'register_template_types' ) );
	}


	/**
	 * Register template types.
	 *
	 * @return void
	 */
	public function register_template_types() {
		$labels = array(
			'name'          => __( $this->name, $this->plugin_slug ),
			'singular_name' => __( $this->singular_name, $this->plugin_slug ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => $this->menu,
			'show_in_rest'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->slug ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => 8,
			'supports'           => array( 'title', 'editor' ),
			'yarpp_support'      => true,
			'template'           => array(
				array( 'omnipress/container', array() ),
			),
		);
		register_post_type( $this->type, $args );
	}
}
