<?php
namespace masud\Press;

class Press
{   
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * Check if Press config file has been published and set.
     *
     * @return bool
     */
    public function configNotPublished(){
    	return is_null(config('press'));
    }

    /**
     * Get an instance of the set driver.
     *
     * @return mixed
     */
    public function driver(){
    	$driver = ucwords(config('press.driver')); // file to File

    	$class = 'masud\Press\Drivers\\'. $driver . 'Driver'; // masud\Press\Driver\FileDriver

    	return new $class;
    }

    /**
     * Get the currently set URI path for the blog.
     *
     * @return string
     */
    public function path()
    {
        return config('press.prefix', 'blogs');
    }

    /**
     * Merges an array of fields into the fields variable.
     *
     * @param array $fields
     */
    public function fields(array $fields){
        $this->fields = array_merge($this->fields, $fields);
    }

    /**
     * Returns the list of available fields in reverse order.
     *
     * @return array
     */
    public function availableFields()
    {
        return array_reverse($this->fields);
    }
}