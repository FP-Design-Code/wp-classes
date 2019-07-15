<?php

namespace FloatingPoint\Wp;

/**
 * Base class for regisering post types with WordPress
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
abstract class PostType
{
    /**
     * The singular title for the post type
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $title_singular    Post Type Singular Title.
     */
    public $title_singular;

    /**
     * The plural title for the post type
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $title_plural    Post Type Plural Title.
     */
    public $title_plural;

    /**
     * The text domain for i18n
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $text_domain    WP Text Domain
     */
    public $text_domain;


    /**
     * The slug for the post type
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $icon    Post Type Slug
     */
    public $slug;

    /**
     * The post type icon
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $icon    Icon
     */
    private $icon;

    /**
     * The post types labels
     *
     * @since    1.0.0
     * @access   private
     * @var      array<string>    $labels    Labels
     */
    private $labels;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string	$title       		The title of the page.
     * @param      string	$slug				URL Slug of page.( optional )
     * @param      string	$icon				Icon in the menu.( optional )
     * @param      int    	$position			Position in the menu.( optional )
     * @param      array    $args				Overide any arguments
     */
    public function __construct($title_singular, $title_plural, $text_domain = 'fp', $slug = null, $icon = null, $position = null, $args = [])
    {
        $this->title_singular = $title_singular;
        $this->title_plural = $title_plural;
        $this->text_domain = $text_domain;
        $this->slug = is_null($slug) ? $title_singular : $slug;
        $this->slug = sanitize_key($this->slug);

        $this->icon = is_null($icon) ? 'dashicons-admin-post' : $icon;
        $this->position = is_null($position) ? 99 : $position;
        $this->labels = Utils::arrayRemove($args, 'labels');

        $args = wp_parse_args($args, $this->get_default_arguments());

        if (!post_type_exists($this->slug)) {
            $this->register($args);
        }
    }

    /**
     * Get default post type arguments
     *
     * @return array Default column values
     */
    private function get_default_arguments()
    {
        $labels = [
            'name'                  => _x($this->title_plural, $this->title_singular . ' General Name', $this->text_domain),
            'singular_name'         => _x($this->title_singular, $this->title_singular . ' Singular Name', $this->text_domain),
            'menu_name'             => __($this->title_plural, $this->text_domain),
            'name_admin_bar'        => __($this->title_singular, $this->text_domain),
            'archives'              => __($this->title_singular . ' Archives', $this->text_domain),
            'attributes'            => __($this->title_singular . ' Attributes', $this->text_domain),
            'parent_item_colon'     => __('Parent ' . $this->title_singular . ':', $this->text_domain),
            'all_items'             => __('All ' . $this->title_plural, $this->text_domain),
            'add_new_item'          => __('Add New ' . $this->title_plural, $this->text_domain),
            'add_new'               => __('Add New', $this->text_domain),
            'new_item'              => __('New ' . $this->title_singular, $this->text_domain),
            'edit_item'             => __('Edit ' . $this->title_singular, $this->text_domain),
            'update_item'           => __('Update ' . $this->title_singular, $this->text_domain),
            'view_item'             => __('View ' . $this->title_singular, $this->text_domain),
            'view_items'            => __('View ' . $this->title_plural, $this->text_domain),
            'search_items'          => __('Search ' . $this->title_plural, $this->text_domain),
            'not_found'             => __('No ' . strtolower($this->title_plural) . ' found', $this->text_domain),
            'not_found_in_trash'    => __('No ' . strtolower($this->title_plural) . ' found in Trash', $this->text_domain),
            'featured_image'        => __('Featured Image', $this->text_domain),
            'set_featured_image'    => __('Set featured image', $this->text_domain),
            'remove_featured_image' => __('Remove featured image', $this->text_domain),
            'use_featured_image'    => __('Use as featured image', $this->text_domain),
            'insert_into_item'      => __('Insert into ' . strtolower($this->title_singular), $this->text_domain),
            'uploaded_to_this_item' => __('Uploaded to this ' . strtolower($this->title_singular), $this->text_domain),
            'items_list'            => __($this->title_plural . ' list', $this->text_domain),
            'items_list_navigation' => __($this->title_plural . ' list navigation', $this->text_domain),
            'filter_items_list'     => __('Filter ' . strtolower($this->title_plural) . ' list', $this->text_domain),
        ];

        if ($this->labels) {
            $labels = wp_parse_args($this->labels, $labels);
        }

        return [
            'labels' => $labels,
            'supports' 				=> [
                'editor',
                'title',
                'revisions',
                'thumbnail',
                'custom-fields',
                'page-attributes'
            ],
            'taxonomies'			=> [],
            'hierarchical'			=> false,
            'public'				=> true,
            'show_ui'				=> true,
            'show_in_menu'			=> true,
            'menu_icon'				=> $this->icon,
            'menu_position'			=> $this->position,
            'show_in_admin_bar'		=> true,
            'show_in_nav_menus'		=> true,
            'show_in_rest'          => true,
            'can_export'			=> true,
            'has_archive'			=> true,
            'exclude_from_search'	=> false,
            'publicly_queryable'	=> true,
            'capability_type'		=> 'page'
        ];
    }

    /**
     * Register the post type with WordPress
     *
     * @return array Default column values
     */
    private function register($args)
    {
        register_post_type($this->slug, $args);
    }
}
