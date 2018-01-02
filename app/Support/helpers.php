<?php

if (! function_exists('bcrypt')) {
    /**
     * Hash the given value.
     *
     * @param string $value
     * @param array  $options
     *
     * @return string
     */
    function bcrypt(string $value, array $options = [])
    {
        return app('hash')->make($value, $options);
    }
}
