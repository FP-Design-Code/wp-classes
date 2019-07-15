<?php

namespace FloatingPoint\Wp\Rewrites;

/**
 * Define the rules for a Tag
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\FpHelps
 * @author	FloatingPoint
 */
abstract class Tag
{
    /**
     * Tag
     *
     * The tag
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $tag
     */
    public $tag;

    /**
     * Regex
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $regex
     */
    public $regex;

    /**
     * Query
     *
     * @since	1.0.0
     * @access	public
     * @var		string	$query
     */
    public $query;

    /**
     * Instantiate the Tag
     *
     * @param	string	$tag
     * @param	string	$regex
     * @param	string	$query
     * @return void
     */
    public function __construct($tag, $regex, $query = '')
    {
        $this->tag = $tag;
        $this->regex = $regex;
        $this->query = $query;
    }
}
