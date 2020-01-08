<?php
namespace masud\Press\Drivers;

use masud\Press\PressFileParser;
use Illuminate\Support\Str; 

abstract class Driver
{	
	protected $config;
    protected $posts = [];

    public function __construct(){
    	$this->setConfig();
    	$this->validateSource();
    }

    protected function setConfig(){
    	$this->config = config('press.'. config('press.driver'));
    }

    public abstract function fetchPosts();

    protected function validateSource(){
    	return true;
    }

    protected function parse($content, $identifier){
        $this->posts[] = array_merge(
            (new PressFileParser($content))->getData(),
            ['identifier' => Str::slug($identifier)]);
    }
}