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
*@TODO: check ressource ?
*/
function display_null () {
	echo "NULL\n";
}
function display_boolean ($value) {
	if ($value === false) {
		echo "bool(false)" . "\n";
	} else {
		echo "bool(true)" . "\n";
	}
}
function display_string ($value) {
	echo 'string(' . strlen($value) . ') "' . $value . '"' . "\n";
}
function display_int ($value) {
	echo "int(" . $value . ")\n";
}
function display_double ($value) {
	echo "double(" . $value . ")\n";
}
function display_array ($value) {
	$space_repeat_count = 2;
	echo "array(" . count($value) . ") {\n";
	foreach ($value as $value_key => $value_value) {
		echo str_repeat(" ", $space_repeat_count) . "'" . $value_key . "' =>\n";
	}
}
function my_vardump ($value) {
	if (is_array($value)) {
		display_array($value);
	} elseif (is_bool($value)) {
		display_boolean($value);
	} elseif (is_float($value) || is_double($value)) {
		display_double($value);
	} elseif (is_int($value)) {
		display_int($value);
	} elseif (is_null($value)) {
		display_null();
	} elseif (is_object($value)) {
	} elseif (is_string($value)) {
		display_string($value);
	}
}