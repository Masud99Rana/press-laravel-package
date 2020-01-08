<?php
namespace masud\Press\Fields;

use Carbon\Carbon;

class Extra extends FieldContract
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
		
		$extra = isset($data['extra']) ? (array)json_decode($data['extra']) : [];
		
		return [
			'extra' => json_encode(array_merge($extra,[
				$type => $value,
			]))
		];

	}
}