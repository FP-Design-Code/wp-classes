<?php

namespace FloatingPoint\Wp;

/**
 * Add a Metabox to WordPress
 *
* @package    Floatingpoint\Wp
* @author     Eric Sizer <esizer@floating-point.com>
 */
abstract class MetaBox
{
    /**
     * ID
     *
     * Unique ID to use for the metabox
     *
     * @since	1.0.0
     * @access	public
     * @var		string	$id		ID for the metabox
     */
    public $id;

    /**
     * Title
     *
     * The title to be displayed for the metabox
     *
     * @since	1.0.0
     * @access	public
     * @var 	string	$title	Metabox title
     */
    public $title;

    /**
     * Screen
     *
     * The screen in which to display the metabox
     *
     * @since	1.0.0
     * @access	public
     * @var		string		$screen
     */
    public $screen;

    /**
     * Context
     *
     * Where on the screen to display metabox
     *
     * @since	1.0.0
     * @access	public
     * @var		string		$context
     */
    public $context;

    /**
     * Priority
     *
     * How high to display the metabox
     *
     * @since	1.0.0
     * @access	public
     * @var		string		$priority
     */
    public $priority;

    /**
     * Callback Arguments
     *
     * Arguments to pass to the render callback function
     *
     * @since	1.0.0
     * @access	public
     * @var		array<mixed>	$callbackArgs
     */
    public $callbackArgs;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param	string	$id
     * @param	string	$title
     * @param	string	$screen
     * @param	string	$priority
     * @param	string	$context
     * @param	array<mixed> $callbackArgs
     * @return void
     */
    public function __construct($id, $title, $screen = null, $context = 'advanced', $priority = 'default', $callbackArgs = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->screen = $screen;
        $this->priority = $priority;
        $this->context = $context;
        $this->callbackArgs = $callbackArgs;

        add_meta_box(
            $this->id,
            $this->title,
            [$this, 'render'],
            $this->screen,
            $this->context,
            $this->priority,
            $this->callbackArgs
        );
    }

    /**
     * Render the shortcode
     *
     * @since	1.0.0
     * @param	array<mixed>	$atts		Attributes passed to shortcode
     * @return	void			Echo the callback
     */
    abstract public function render();
}
