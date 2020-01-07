<?php
namespace masud\Press\Fields;

use Carbon\Carbon;

abstract class FieldContract
{
	public static function process($fieldType, $fieldValue, $data){
		
		return [$fieldType => $fieldValue];
	}
}