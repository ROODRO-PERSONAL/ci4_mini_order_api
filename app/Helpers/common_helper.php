<?php

if (!function_exists('current_timestamp')) {
    /**
    
     *
     * @return int
     */
    function current_timestamp(): int
    {
        return time();
    }
}
