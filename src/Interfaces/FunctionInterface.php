<?php

namespace FpPrograms\Interfaces;

/**
 * Interface for Initializable classes
 */
interface FunctionInterface
{
    /**
     * Gets the unique identifier for the theme functions.
     *
     * @return string Function slug.
     */
    public function getSlug() : string;

    /**
     * Get exposed functions
     *
     * @return	array	Associative array containing functions
     * 					$method => $callback
     */
    public function functions() : array;
}
