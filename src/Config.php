<?php

namespace FloatingPoint\Wp;

/**
 * Get the config of the plugin
 *
 * Before using you must define a constant for FP_CONFIG_FILE
 * which contains the configuration values.
 *
 * @since 1.0.0
 *
 * @package	FloatingPoint\Wp
 * @author	FloatingPoint
 */
class Config
{
    /**
     * Get the config
     */
    public static function get()
    {
        return require FP_CONFIG_FILE;
    }

    /**
     * Get a value from Config array
     *
     * @param   $key    The key in the array
     * @return mixed    The value from the array
     */
    public static function getValue($key)
    {
        if (!$key) {
            return false;
        }

        $config = self::get();
        return isset($config[$key]) ? $config[$key] : false;
    }
}
