<?php
namespace masud\Press\Fields;

use masud\Press\MarkdownParser;

class Body extends FieldContract
{
	/**
	 * Process the field and make any modifications.
	 *
	 * @param $fieldType
	 * @param $fieldValue
	 * @param $data
	 *
	 * @return array
	 */
	public static function process($type, $value, $data){
		
		return [
			$type => MarkdownParser::parse($value)
		];
	}
}