<?php

namespace FloatingPoint\Wp;

/**
 * WordPress Shortcode base class
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
abstract class Shortcode
{
    /**
     * Tag
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $tag    The tag used for Shortcode [tag]
     */
    public $tag;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct($tag)
    {
        $this->tag = $tag;

        add_shortcode($this->tag, [$this, 'render']);
    }

    /**
     * Render the shortcode
     *
     * @since	1.0.0
     * @param	array<mixed>	$atts		Attributes passed to shortcode
     * @param	string			$content	Content inside the shortcode
     * @return	string			HTML to be rendered in the browser
     */
    abstract public function render($atts, $content);
}
