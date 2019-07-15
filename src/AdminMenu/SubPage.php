<?php

namespace FloatingPoint\Wp\AdminMenu;

/**
 * Base class for regisering admin sub menu pages with WordPress
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
abstract class SubPage
{
    /**
     * Parent Page Slug
     *
     * The slug of the menu page to add this sub page to
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $parent_slug
     */
    public $parent_slug;

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
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string	$parent_slug		Parent page slug.
     * @param      string	$page_title			The title of the page.
     * @param      string	$menu_title			The title for the menu link text
     * @param      string	$capability			WordPress capabilities  required to see the page
     * @param      string	$slug				Menu Slug (optional)
     * @param      array    $icon				Icon for the menu link
     * @param      int		$position			Where to place the menu item
     */
    public function __construct($parent_slug, $page_title, $menu_title, $capability, $slug = null, $icon = null, $position = null)
    {
        $this->parent_slug = $parent_slug;
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->slug = is_null($slug) ? $page_title : $slug;
        $this->slug = sanitize_key($this->slug);

        $this->capability = $capability;

        $this->register();
    }

    /**
     * Register the admin page with WordPress
     *
     * @since	1.0.0
     */
    public function register()
    {
        add_submenu_page(
            $this->parent_slug,
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->slug,
            [$this, 'render']
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
