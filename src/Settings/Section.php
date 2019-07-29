<?php

namespace FloatingPoint\Wp\Settings;

/**
 * Class to register a settings section with WordPress
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class Section
{
    /**
     * Unique Id for the section
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $id
     */
    public $id;

    /**
     * Title of the section
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $title
     */
    public $title;

    /**
     * The callback function to render the section
     *
     * @since    1.0.0
     * @access   public
     * @var      function    $render
     */
    public $render;

    /**
     * Page to display the section on
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $page
     */
    public $page;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct($id, $title, $render, $page)
    {
        $this->id = $id;
        $this->title = $title;
        $this->render = $render;
        $this->page = $page;

        add_settings_section(
            $this->id,
            $this->title,
            $this->render,
            $this->page
        );
    }
}
