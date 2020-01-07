<?php
namespace masud\Press\Fields;

use Carbon\Carbon;

class Date
{
	public static function process($type, $value){
		
		$type = Carbon::parse($value);
		return $type;
	}
}