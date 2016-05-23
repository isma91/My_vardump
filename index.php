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
function my_vardump ($value) {
	if (is_array($value)) {
	} elseif (is_bool($value)) {
		if ($value === false) {
			echo "bool(false)" . "\n";
		} else {
			echo "bool(true)" . "\n";
		}
	} elseif (is_float($value) || is_double($value)) {
		echo "double(" . $value . ")\n";
	} elseif (is_int($value)) {
		echo "int(" . $value . ")\n";
	} elseif (is_null($value)) {
		echo "NULL\n";
	} elseif (is_object($value)) {
	} elseif (is_string($value)) {
		echo 'string(' . strlen($value) . ') "' . $value . '"' . "\n";
	}
	return "unknown type";
}
my_vardump(__DIR__);
var_dump(__DIR__);