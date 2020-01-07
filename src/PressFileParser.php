<?php
namespace masud\Press;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use masud\Press\MarkdownParser;

class PressFileParser{

	/**
	 * @var string
	 */
	protected $filename;

	/**
	 * @var array
	 */
	protected $data;

	/**
	 * @var array
	 */
	protected $rawData;
	

	/**
	 * PressFileParser constructor.
	 *
	 * @param $filename
	 */
	public function __construct($filename){
		
		$this->filename = $filename;
		$this->splitFile();

		$this->explodeData();
		$this->processFields();
	}

	public function getData()
	{
		return $this->data;
	}	

	public function getRawData()
	{
		return $this->rawData;
	}

	protected function splitFile()
	{	
		preg_match('/^\-{3}(.*?)\-{3}(.*)/s',
            File::exists($this->filename) ? File::get($this->filename) : $this->filename,
            $this->rawData
        );

        // dd($this->data);
	}


	/**
	 * Separate each line in the head, trims it and saves it, along with the body.
	 *
	 * @return void
	 */
	protected function explodeData(){

		// dd(trim($this->data[1]));
		
		// dd(explode("\n", trim($this->data[1])));
		
		foreach (explode("\n", trim($this->rawData[1])) as $fieldString) {
		    preg_match('/(.*):\s?(.*)/', $fieldString, $fieldArray);
		    $this->data[$fieldArray[1]] = trim($fieldArray[2]);
		}

		// dd(trim($this->data[2]));
		$this->data['body'] = trim($this->rawData[2]);

	}

	protected function processFields(){

		foreach ($this->data as $field => $value) {
			// Date::process($field, $value)// field = date, value = 'January 07, 2020';
			
			$class = "masud\\Press\\Fields\\" . ucwords($field);

			if(! class_exists($class) &&  ! method_exists($class, 'process')){
				$class = "masud\\Press\\Fields\\Extra";	
			}
			
			$processedData= $class::process($field, $value, $this->data);
			$this->data = array_merge($this->data, $processedData);
		}
	}


}