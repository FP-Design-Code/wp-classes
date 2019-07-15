<?php

namespace FloatingPoint\Wp\Rewrites;

/**
 * Define the rewrite rule class
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\FpHelps
 * @author	FloatingPoint
 */
abstract class Rule
{
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
     * After
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $after
     */
    public $after;


    /**
     * Instantiate the Rewrite Rule
     *
     * @param	string	$tag
     * @param	string	$regex
     * @param	string	$query
     * @return void
     */
    public function __construct($regex, $query, $after = 'bottom')
    {
        $this->regex = $regex;
        $this->query = $query;
        $this->after = $after;
    }
}
