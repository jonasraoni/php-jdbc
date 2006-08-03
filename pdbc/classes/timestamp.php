<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: timestamp.php,v 1.0 2006/05/09 17:36:00
* @abstract A thin wrapper around java.util.Date that allows the JDBC API to identify this as an SQL TIMESTAMP value. It adds the ability to hold the SQL TIMESTAMP fractional seconds value, by allowing the specification of fractional seconds to a precision of nanoseconds. A Timestamp also provides formatting and parsing operations to support the JDBC escape syntax for timestamp values
*/

class Timestamp{
	/**
	* Constructs a Timestamp object using a milliseconds time value
	* @param Long $time
	*/
	function Timestamp($time){
	}

	/**
	* Indicates whether this Timestamp object is later than the given Timestamp object
	* @param Timestamp ts
	* @return Boolean
	*/
	function after($ts){

	}

	/**
	* Indicates whether this Timestamp object is earlier than the given Timestamp object
	* @param Timestamp ts
	* @return Boolean
	*/
	function before($ts){
	}

	/**
	* Compares this Timestamp object to the given Timestamp object
	* @param Timestamp ts
	* @return Integer
	*/
	function compareTo($ts){
	}

	/**
	* Tests to see if this Timestamp object is equal to the given Timestamp object
	* @param Timestamp ts
	* @return Boolean
	*/
	function equals($ts){
	}

	/**
	* Gets this Timestamp object's nanos value
	* @return Integer
	*/
	function getNanos(){
	}

	/**
	* Returns the number of milliseconds since January 1, 1970, 00:00:00 GMT represented by this Timestamp object
	* @return Long
	*/
	function getTime(){
	}

	/**
	* Sets this Timestamp object's nanos field to the given value
	* @param Integer $n
	* @return void
	*/
	function setNanos($n){
	}

	/**
	* Sets this Timestamp object to represent a point in time that is time milliseconds after January 1, 1970 00:00:00 GMT
	* @param Long $time
	* @return void
	*/
	function setTime($time){
	}

	/**
	* Formats a timestamp in JDBC timestamp escape format
	* @return String
	*/
	function toString(){
	}
}
?>