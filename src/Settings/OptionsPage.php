<?php

namespace FloatingPoint\Wp\Settings;

use FloatingPoint\Wp\Config;
use FloatingPoint\Wp\Utils;

/**
 * Class to control the Options page for the plugin
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class OptionsPage
{
    /**
     * Title of the page
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $pageTitle
     */
    public $pageTitle;

    /**
     * Menu Link Title
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $menuTitle
     */
    public $menuTitle;

    /**
     * Capabilities require to view page
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $capability
     */
    public $capability;

    /**
     * Unique Slug of the page
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $menuSlug
     */
    public $menuSlug;

    /**
     * Icon for the page
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $icon
     */
    public $icon;

    /**
     * Position to display the page in
     *
     * @since    1.0.0
     * @access   public
     * @var      int    $icon
     */
    public $position;

    /**
     * The callback function to render the page
     *
     * @since    1.0.0
     * @access   public
     * @var      function    $render
     */
    public $render;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct($pageTitle, $menuTitle, $menuSlug, $render, $icon = null, $capability = 'manage_options', $position = null)
    {
        $this->pageTitle = $pageTitle;
        $this->menuTitle = $menuTitle;
        $this->capability = $capability;
        $this->menuSlug = $menuSlug;
        $this->icon = $icon;
        $this->position = $position;

        add_menu_page(
            $this->pageTitle,
            $this->menuTitle,
            $this->capability,
            $this->menuSlug,
            [$this, 'render'],
            $this->icon,
            $this->position
        );
    }

    /**
     * Render the Options page
     *
     * @since	1.0.0
     * @return void
     */
    public function render()
    {
        echo '<form action="options.php" method="POST">';
        echo '<h2>' . $this->pageTitle . '</h2>';

        settings_fields($this->menuSlug);
        do_settings_sections($this->menuSlug);
        submit_button();

        echo '</form>';
    }
}
