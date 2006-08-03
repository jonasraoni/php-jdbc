<?php
/**
* @package dao
* @subpackage classes
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: transfer-field.php,v 1.0 2006/05/25 11:53:52
* @abstract Keeps basic information of a database field
*/

/** The field is part of the primary key */
define('FIELD_PRIMARY', 1 << 0);
/** The field accepts null */
define('FIELD_NULLABLE', 1 << 1);
/** The field accepts negative numbers */
define('FIELD_SIGNED', 1 << 2);
/** The field is auto-increment */
define('FIELD_AUTOINC', 1 << 3);

class TransferField{
	var $changed = false, $check = true, $name, $field, $value, $default, $basetype, $type, $length, $flags;

	/**
	* Class constructor
	* @param String $name Name
	* @param String $field Real field name
	* @param Mixed $default Field default value
	* @param Integer $basetype Field base (sql) type
	* @param String $type "PHP type"
	* @param Integer $length The length of the field
	* @param Integer $flags The field options
	*/
	function &TransferField($name, $field, $default, $basetype, $type, $length, $flags){
		$this->name = $name;
		$this->field = $field;
		$this->value = $this->default = $default;
		$this->type = $type;
		$this->basetype = $basetype;
		$this->length = $length;
		$this->flags = $flags;
		return $this;
	}

	/**
	* Retrieves whether the field is nullable
	* @return Boolean
	*/
	function isNullable(){
		return (bool)($this->flags & FIELD_NULLABLE);
	}

	/**
	* Retrieves whether the field is auto-incremental
	* @return Boolean
	*/
	function isAutoInc(){
		return (bool)($this->flags & FIELD_AUTOINC);
	}

	/**
	* Retrieves whether the field is part of the primary key
	* @return Boolean
	*/
	function isKey(){
		return (bool)($this->flags & FIELD_PRIMARY);
	}

	/**
	* Retrieves whether the field is signed
	* @return Boolean
	*/
	function isSigned(){
		return (bool)$this->flags & FIELD_SIGNED;
	}
}
?>