<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: driver-property-info.php,v 1.0 2006/05/09 17:36:00
* @abstract Driver properties for making a connection. The DriverPropertyInfo class is of interest only to advanced programmers who need to interact with a Driver via the method getDriverProperties to discover and supply properties for connections.
*/

class DriverPropertyInfo{
	/* An array of possible values if the value for the field DriverPropertyInfo.value may be selected from a particular set of values; otherwise null */
	var $choices = array();
	/* A brief description of the property, which may be null */
	var $description = '';
	/*  The required field is true if a value must be supplied for this property during Driver.connect and false otherwise */
	var $required = false;
	/* The name of the property */
	var $name;
	/* The value field specifies the current value of the property, based on a combination of the information supplied to the method getPropertyInfo, the Java environment, and the driver-supplied default values */
	var $value;

	/**
	* Constructs a DriverPropertyInfo object with a given name and value
	* @param String $name
	* @param String $value
	*/
	function DriverPropertyInfo($name, $value){
		$this->name = $name;
		$this->value = $value;
	}
}
?>