<?php
namespace masud\Press\Fields;

use Carbon\Carbon;

class Date extends FieldContract
{
	public static function process($type, $value, $data){
		
		$processedData = Carbon::parse($value);
		return [
			'date' => $processedData
		];
	}
}