<?php
namespace masud\Press\Drivers;

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

    protected function validateSource(){
    	return true;
    }
}