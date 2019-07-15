<?php

namespace FloatingPoint\Wp\Meta;

/**
 * Utitlies to retirve and store meta values
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class Value
{
    /**
     * Get the meta value
     */
    public static function get($id, $field, $single = true)
    {
        return get_post_meta($id, $field, $single);
    }

    /**
     * Update and exisiting meta value
     */
    public static function update($id, $field, $value)
    {
        return update_post_meta($id, $field, $value);
    }

    /**
     * Update an exisiting meta value
     */
    public static function add($id, $field, $value)
    {
        return add_post_meta($id, $field, $value);
    }

    /**
     * Delete an exisiting meta value
     */
    public static function delete($id, $field, $value)
    {
        return delete_post_meta($id, $field, $value);
    }
}
