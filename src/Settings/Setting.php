<?php

namespace FloatingPoint\Wp\Settings;

/**
 * Class to register a setting with WordPress
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class Setting
{
    /**
     * Option Group Name
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $Group
     */
    public $group;

    /**
     *  Name
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $name
     */
    public $name;

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
    public function __construct($group, $name, $args = [])
    {
        $this->group = $group;
        $this->name = $name;
        $this->args = $args;

        register_setting(
            $this->group,
            $this->name,
            $this->args
        );
    }
}
