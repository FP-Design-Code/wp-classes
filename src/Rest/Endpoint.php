<?php

namespace FloatingPoint\Wp\Rest;

/**
 * WordPress REST API Endpoint base class
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
abstract class Endpoint
{
    /**
     * Endpoint Prefix
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $prefix    Endpoint prefix
     */
    public $prefix;

    /**
     * Endpoint Base
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $base    Endpoint base
     */
    public $base;

    /**
     * Endpoint
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $endpoint    The Actual endpoint
     */
    public $endpoint;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct($prefix, $endpoint, $version)
    {
        $this->base = $prefix . '/' . $version;
        $this->endpoint = $endpoint;
    }

    /**
     * Regiter a route with WordPress
     *
     * @since 1.0.0
     */
    public function register($args, $suffix = '')
    {
        register_rest_route($this->base, $this->endpoint . $suffix, $args);
    }
}
