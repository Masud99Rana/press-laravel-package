<?php
namespace masud\Press\Fields;

use Carbon\Carbon;
use masud\Press\MarkdownParser;

class Body
{
	public static function process($type, $value){
		
		return [
			$type => MarkdownParser::parse($value)
		];
	}
}