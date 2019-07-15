<?php

namespace FloatingPoint\Wp;

/**
 * Base class for regisering admin menu pages with WordPress
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
abstract class MenuPage
{
    /**
     * The Page Title
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $page_title
     */
    public $page_title;

    /**
     * The Menu Title
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $menu_title
     */
    public $menu_title;


    /**
     * The Capability required to view the page
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $capability
     */
    public $capability;

    /**
     * The slug for the page
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $menu_slug
     */
    private $slug;

    /**
     * THow high to display the page
     *
     * @since    1.0.0
     * @access   private
     * @var      int    $position
     */
    private $position;

    /**
     * The post type icon
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $icon    Icon
     */
    private $icon;

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
    public function __construct($page_title, $menu_title, $capability, $slug = null, $icon = null, $position = null)
    {
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->slug = is_null($slug) ? $title_singular : $slug;
        $this->slug = sanitize_key($this->slug);

        $this->capability = $capability;
        $this->icon = is_null($icon) ? 'dashicons-admin-post' : $icon;
        $this->position = is_null($position) ? 99 : $position;

        if (empty($GLOBALS['admin_page_hooks'][$this->slug])) {
            $this->register();
        }
    }

    /**
     * Register the admin page with WordPress
     *
     * @since	1.0.0
     */
    private function register()
    {
        add_menu_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->slug,
            [$this, 'render'],
            $this->icon,
            $this->position
        );
    }

    /**
     * Render the Admin Page
     *
     * @since	1.0.0
     * @return	string			HTML to be rendered in the browser
     */
    abstract public function render();
}
