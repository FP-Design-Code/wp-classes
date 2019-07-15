<?php

namespace FloatingPoint\Wp\Meta;

/**
 * Register a meta field for use in Block editor
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class Field
{

    /**
     * Key
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $key    The meta value key
     */
    public $key;

    /**
     * Args
     *
     * REF: https://developer.wordpress.org/reference/functions/register_meta/
     *
     * @since	1.0.0
     * @access	public
     * @var		array<mixed>	$args	Misc args
     */

    /**
     * Initialize the class and set its properties.
     *
     * @since	1.0.0
     * @param	string		$title		The title of the metabox
     */
    public function __construct($key, $args = [])
    {
        $this->key = $key;
        $this->args = wp_parse_args($args, $this->get_default_arguments());

        $this->register();
    }

    /**
     * Get default post type arguments
     *
     * @return array Default column values
     */
    private function get_default_arguments()
    {
        return [
            'type'			=> 'string',
            'description'	=> '',
            'single'		=> true,
            'show_in_rest'	=> true
        ];
    }

    /**
     * Register the Meta
     *
     * @since	1.0.0
     */
    public function register()
    {
        register_meta('post', $this->key, $this->args);
    }
}
