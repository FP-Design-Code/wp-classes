<?php

namespace FloatingPoint\Wp;

/**
 * WordPress Dynamic Gutenberg block
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\FpPortal
 * @author	FloatingPoint
 */
abstract class Block
{

    /**
     * Editor Script
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $editor_script    The js file that contains the block
     */
    public $editor_script;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct($name, $editor_script, $callback)
    {
        $this->editor_script = $editor_script;
        $this->register($name, $callback);
    }

    /**
     * Regiter a route with WordPress
     *
     * @since 1.0.0
     */
    public function register($name, $callback)
    {
        register_block_type($name, [
            'editor_script' => $this->editor_script,
            'render_callback' => $callback
        ]);
    }
}
