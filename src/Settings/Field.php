<?php

namespace FloatingPoint\Wp\Settings;
/**
 * Class to register a settings field with WordPress
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class Field
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
     * Section to display the field in
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $section
     */
    public $section;

    /**
     * Values for Select, Radio, Checkbox tpye fields
     *
     * @since    1.0.0
     * @access   public
     * @var      array<string>    $values
     */
    public $values;

    /**
     * Arguments
     *
     * @since    1.0.0
     * @access   public
     * @var      array<mixed>    $args
     */
    public $args;


    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct($id, $title, $render, $page, $section, $values = [], $args = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->render = $render;
        $this->page = $page;
        $this->section = $section;
        $this->values = $values;
        $this->args = $args;

        $this->args = array_merge($args, get_object_vars($this));

        add_settings_field(
            $this->id,
            $this->title,
            $this->render,
            $this->page,
            $this->section,
            $this->args
        );
    }
}
