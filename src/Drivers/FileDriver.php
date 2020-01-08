<?php
namespace masud\Press\Drivers;

use Illuminate\Support\Facades\File;
use masud\Press\Exceptions\FileDriverDirectoryNotFoundException;
use Illuminate\Support\Str; 

class FileDriver extends Driver
{
    /**
     * Fetch and parse all of the posts for the given source.
     *
     * @return mixed
     */
    public function fetchPosts(){

    	//Fetch all posts
    	$files = File::files($this->config['path']);

    	//Process each file
    	foreach ($files as $file) {
    	    
            $this->parse($file->getPathname(), $file->getFilename());
    	}

    	return $this->posts;
    }

    /**
     * Instantiates the PressFileParser and build up an array of posts.
     *
     * @return bool|void
     * @throws \masud\Press\Exceptions\FileDriverDirectoryNotFoundException
     *
     * @return void
     */
    protected function validateSource(){

    	if( ! File::exists($this->config['path'])){
    		throw new FileDriverDirectoryNotFoundException('Directory at \''. $this->config['path'] . '\' does not exist. '.
    			'Check the directory path in the config file.');
    	}
    	
    }
}