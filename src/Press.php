<?php
namespace masud\Press;

class Press
{
    public static function configNotPublished(){
    	return is_null(config('press'));
    }

    public static function driver(){
    	$driver = ucwords(config('press.driver')); // file to File

    	$class = 'masud\Press\Drivers\\'. $driver . 'Driver'; // masud\Press\Driver\FileDriver

    	return new $class;
    }

    /**
     * Get the currently set URI path for the blog.
     *
     * @return string
     */
    public static function path()
    {
        return config('press.prefix', 'blogs');
    }
}