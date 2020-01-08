<?php
namespace masud\Press\Fields;

use Carbon\Carbon;

class Date extends FieldContract
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
		
		$processedData = Carbon::parse($value);
		return [
			'date' => $processedData
		];
	}
}