<?php

App::bind('retrieveClassCode', function($app, $classes) 
{
	$matches = [];
	$i = 0;
	foreach ($classes as $class) {
		$classCode = explode('/', $class->class);
		if (count($classCode) > 1){
			$pattern = "[a-z][a-z]";
			preg_match('/[A-Za-z]+/', $classCode[1], $matches[$i]);
			$matches[$i]['class_code'] = $classCode[0] . "/" . $classCode[1];
		}
		if (count($classCode) == 1) {
			$matches[$i]['reg'] = $classCode[0];
		}
		$i++;
	}
	if($matches) {
		return $matches;
	}
});
