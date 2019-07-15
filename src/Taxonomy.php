<?php

namespace FloatingPoint\FpMetrics\Taxonomies;

/**
* Class to add Taxonomy
*
* Defines all of the pages that need to be in admin area.
*
* @package    FpBase
* @author     Eric Sizer <esizer@floating-point.com>
*/

abstract class Taxonomy
{

    /**
     * The post types to add the taxonomy to
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $post_object    Post Type Slug
     */
    public $post_object;

    /**
     * The Name of the custom taxonomy
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $singular    Singluar Name.
     */
    public $singular;

    /**
     * The Name of the taxonomy pluralized
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plural    Plural Name.
     */
    public $plural;

    /**
     * The text domain for i18n
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $text_domain    WP Text Domain
     */
    public $text_domain;

    /**
     * The machine readable name of the taxonomy
     *
     * @since    1.0.0
     * @access   public
     * @var      array    $slug		Taxonomy Slug
     */
    public $slug;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string	$post_object	The slug of the post type
     * @param      string	$singular		The title of the post type
     * @param	   string	$text_domain	The WordPress text domain
     * @param      string	$plural			The pluralized title
     * @param      string	$args			Wordpress Arguments
     */
    public function __construct($post_object, $singular, $text_domain = 'fp', $plural, $slug = null, $args = null)
    {
        $this->post_object = $post_object;
        $this->singular = $singular;
        $this->text_domain = $text_domain;
        $this->plural = $plural;
        $this->slug = is_null($slug) ? sanitize_key($singular) : $slug;

        $args = wp_parse_args($args, $this->get_default_arguments());

        if (! taxonomy_exists($this->slug)) {
            $this->register($args);
        }
    }

    /**
     * Registers the post type
     *
     * @since 1.0.0
     */
    public function register($args)
    {
        register_taxonomy($this->slug, $this->post_object, $args);
    }

    /**
     * Get default taxonomy arguments
     *
     * @return array Default status arguments
     */
    private function get_default_arguments()
    {
        return array(
            'labels' => array(
                'name'                       => _x($this->plural, 'Taxonomy General Name', $this->text_domain),
                'singular_name'              => _x($this->singular, 'Taxonomy Singular Name', $this->text_domain),
                'menu_name'                  => __($this->singular, $this->text_domain),
                'all_items'                  => __('All ' . $this->plural, $this->text_domain),
                'parent_item'                => __('Parent ' . $this->singular, $this->text_domain),
                'parent_item_colon'          => __('Parent ' . $this->singular . ':', $this->text_domain),
                'new_item_name'              => __('New ' . $this->singular  . ' Name', $this->text_domain),
                'add_new_item'               => __('Add New ' . $this->singular, $this->text_domain),
                'edit_item'                  => __('Edit ' . $this->singular, $this->text_domain),
                'update_item'                => __('Update ' . $this->singular, $this->text_domain),
                'view_item'                  => __('View ' . $this->singular, $this->text_domain),
                'separate_items_with_commas' => __('Separate ' . strtolower($this->plural) . ' with commas', $this->text_domain),
                'add_or_remove_items'        => __('Add or remove ' . strtolower($this->plural), $this->text_domain),
                'choose_from_most_used'      => __('Choose from the most used', $this->text_domain),
                'popular_items'              => __('Popular ' . $this->plural, $this->text_domain),
                'search_items'               => __('Search ' . $this->plural, $this->text_domain),
                'not_found'                  => __('Not Found', $this->text_domain),
                'no_terms'                   => __('No ' . strtolower($this->plural), $this->text_domain),
                'items_list'                 => __($this->plural . ' list', $this->text_domain),
                'items_list_navigation'      => __($this->plural . ' list navigation', $this->text_domain),
            ),
            'hierarchical'		=> false,
            'public'			=> true,
            'show_ui'			=> true,
            'show_admin_column'	=> true,
            'show_in_nav_menus'	=> true,
            'show_tagcloud'		=> true,
            'show_in_rest'      => true,
        );
    }
}
