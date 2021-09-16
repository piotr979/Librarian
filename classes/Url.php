<?php

    /** 
     * Url operations
     */

class Url 
{
    /**
     * Redirect to given location
     * @param string $url path to the location
     * 
     * @return void
     */
    public static function redirect($url)
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }
        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $url);
    }
}