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
		echo str_repeat(" ", $space) . "'" . $value_key . "' =>\n";
		my_vardump($value_value, $space);
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
	} elseif (is_string($value)) {
		display_string($value, $space);
	}
}