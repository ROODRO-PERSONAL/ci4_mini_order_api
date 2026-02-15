<?php

if (!function_exists('current_timestamp')) {
    /**
     * বর্তমান সময়ের UNIX timestamp
     *
     * @return int
     */
    function current_timestamp(): int
    {
        return time();
    }
}
