<?php
namespace masud\Press\Drivers;

use masud\Press\PressFileParser;
use Illuminate\Support\Str; 

abstract class Driver
{	
    /**
     * @var array
     */
	protected $config;

    /**
     * @var array
     */
    protected $posts = [];

    /**
     * Driver constructor.
     */
    public function __construct(){
    	$this->setConfig();
    	$this->validateSource();
    }

    /**
     * Fetch the appropriate config array for this source.
     *
     * @return void
     */
    protected function setConfig(){
    	$this->config = config('press.'. config('press.driver'));
    }

    /**
     * Fetch and parse all of the posts for the given source.
     *
     * @return mixed
     */
    public abstract function fetchPosts();

    /**
     * Perform any validation necessary to assert source is valid.
     *
     * @return bool
     */
    protected function validateSource(){
    	return true;
    }

    /**
     * Instantiates the PressFileParser and build up an array of posts.
     *
     * @param $content
     * @param $identifier
     *
     * @return void
     */
    protected function parse($content, $identifier){
        $this->posts[] = array_merge(
            (new PressFileParser($content))->getData(),
            ['identifier' => Str::slug($identifier)]);
    }
}