<?php
namespace masud\Press\Drivers;

use Illuminate\Support\Facades\File;
use masud\Press\Exceptions\FileDriverDirectoryNotFoundException;
use masud\Press\PressFileParser;

class FileDriver extends Driver
{
    public function fetchPosts(){

    	//Fetch all posts
    	$files = File::files($this->config['path']);

    	//Process each file
    	foreach ($files as $file) {
    	    $this->posts[] = (new PressFileParser($file->getPathname()))->getData();
    	}

    	return $this->posts;
    }

    protected function validateSource(){

    	if( ! File::exists($this->config['path'])){
    		throw new FileDriverDirectoryNotFoundException('Directory at \''. $this->config['path'] . '\' does not exist. '.
    			'Check the directory path in the config file.');
    	}
    	
    }
}