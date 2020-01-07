<?php
namespace masud\Press\Fields;

use Carbon\Carbon;
use masud\Press\MarkdownParser;

class Body extends FieldContract
{
	public static function process($type, $value, $data){
		
		return [
			$type => MarkdownParser::parse($value)
		];
	}
}