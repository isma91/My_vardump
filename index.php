<?php
/**
* Index.php
*
* Make a custom var_dump
*
* PHP 7.0.6-13+donate.sury.org~xenial+1 (cli) ( NTS )
*
* @category View
* @package  View
* @author   isma91 <ismaydogmus@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
/*
*@TODO: for display class, need to know how many class has been created ?
*/
function display_null ($space = 0) {
	echo str_repeat(" ", $space) . "NULL\n";
}
function display_boolean ($value, $space = 0) {
	if ($value === false) {
		echo str_repeat(" ", $space) . "bool(false)" . "\n";
	} else {
		echo str_repeat(" ", $space) . "bool(true)" . "\n";
	}
}
function display_string ($value, $space = 0) {
	echo str_repeat(" ", $space) . 'string(' . strlen($value) . ') "' . $value . '"' . "\n";
}
function display_int ($value, $space = 0) {
	echo str_repeat(" ", $space) . "int(" . $value . ")\n";
}
function display_double ($value, $space = 0) {
	echo str_repeat(" ", $space) . "double(" . $value . ")\n";
}
function display_array ($value, $space = 0) {
	echo str_repeat(" ", $space) . "array(" . count($value) . ") {\n";
	$space = $space + 2;
	foreach ($value as $value_key => $value_value) {
		if (is_int($value_key)) {
			echo str_repeat(" ", $space) . "[" . $value_key . "] =>\n";
		} else {
			echo str_repeat(" ", $space) . "'" . $value_key . "' =>\n";
		}
		my_vardump($value_value, $space);
	}
	echo str_repeat(" ", $space - 2) . "}\n";
}
function display_object ($value, $space = 0) {
	$num_property = 0;
	$class = new ReflectionClass($value);
	$array_all_property = array();
	if (count($class->getProperties(ReflectionProperty::IS_PUBLIC)) !== 0) {
		foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $class_public) {
			$array_all_property["public"]["$" . $class_public->getName()] = "";
		}
	}
	if (count($class->getProperties(ReflectionProperty::IS_PRIVATE)) !== 0) {
		foreach ($class->getProperties(ReflectionProperty::IS_PRIVATE) as $class_private) {
			$array_all_property["private"]["$" . $class_private->getName()] = "";
		}
	}
	if (count($class->getProperties(ReflectionProperty::IS_PROTECTED)) !== 0) {
		foreach ($class->getProperties(ReflectionProperty::IS_PROTECTED) as $class_protected) {
			$array_all_property["protected"]["$" . $class_protected->getName()] = "";
		}
	}
	foreach ($array_all_property as $type_property => $array_type_property) {
		foreach ($array_type_property as $key => $property) {
			if ($type_property === "public") {
				$array_all_property[$type_property][$key] = $class->getProperty(substr($key, 1))->getValue($value);
			} else {
				$protected_private_property = $class->getProperty(substr($key, 1));
				$protected_private_property->setAccessible(true);
				$array_all_property[$type_property][$key] = $protected_private_property->getValue($value);
			}
		}
	}
	foreach ($array_all_property as $type_property => $array_type_property) {
		$num_property = $num_property + count($array_type_property);
	}
	echo str_repeat(" ", $space) . "class" . " " . $class->getName() . "# (" . $num_property . ") {\n";
	$space = $space + 2;
	foreach ($array_all_property as $type_property => $array_type_property) {
		foreach ($array_type_property as $property_name => $property_value) {
			echo str_repeat(" ", $space) . $type_property . " " . $property_name . " => \n";
			my_vardump($property_value, $space);
		}
	}
	echo str_repeat(" ", $space - 2) . "}\n";
}
function my_vardump ($value, $space = 0) {
	if (is_array($value)) {
		display_array($value, $space);
	} elseif (is_bool($value)) {
		display_boolean($value, $space);
	} elseif (is_float($value) || is_double($value)) {
		display_double($value, $space);
	} elseif (is_int($value)) {
		display_int($value, $space);
	} elseif (is_null($value)) {
		display_null($space, $space);
	} elseif (is_object($value)) {
		display_object($value, $space);
	} elseif (is_string($value)) {
		display_string($value, $space);
	}
}