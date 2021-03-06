<?php

namespace FloatingPoint\Wp\AdminMenu;

/**
 * Base class for regisering admin menu pages with WordPress
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
abstract class Page
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
     * @access   public
     * @var      string    $menu_slug
     */
    public $slug;

    /**
     * THow high to display the page
     *
     * @since    1.0.0
     * @access   public
     * @var      int    $position
     */
    public $position;

    /**
     * The post type icon
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $icon    Icon
     */
    public $icon;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string	$page_title			The title of the page.
     * @param      string	$menu_title			The title for the menu link text
     * @param      string	$capability			WordPress capabilities  required to see the page
     * @param      string	$slug				Menu Slug (optional)
     * @param      array    $icon				Icon for the menu link
     * @param      int		$position			Where to place the menu item
     */
    public function __construct($page_title, $menu_title, $capability, $slug = null, $icon = null, $position = null)
    {
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->slug = is_null($slug) ? $page_title : $slug;
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
    public function register()
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
