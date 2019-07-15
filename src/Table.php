<?php

namespace FloatingPoint\Wp;

/**
 * Base interface for creating WordPress Tables
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
interface Table
{
    public static function create($db);
}
