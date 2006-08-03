<?php
/**
* @package dao
* @subpackage classes
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: transfer-object.php,v 1.0 2006/05/25 11:53:52
* @abstract This class stores/sets data of a single table record
*/

/** The number is negative */
define('ERROR_ONLY_POSITIVE', 0);
/** Invalid date or time */
define('ERROR_INVALID_DATETIME', 1);
/** Exceeded the max length of the field */
define('ERROR_INVALID_LENGTH', 2);
/** Unknown */
define('ERROR_USER_DEFINED', 3);

require_once DAO_BASE_DIR . 'base-classes/transfer-field.php';

class TransferObject{
	/* List of field objects */
	var $_fields = array();

	/**
	* Class constructor
	* @param TransferField[] $fields
	*/
	function TransferObject($fields = array()){
		for($i = count($fields); $i--; $this->_fields[$fields[$i]->name] = &$fields[$i]);
	}

	/**
	* Sets the value of a field given its name
	* @param String $name The field name
	* @param Mixed $value The field value
	* @param Boolean $check Whether the field should be validated and sql-escaped
	* @return void
	*/
	function set($name, $value, $check = true){
		$f = &$this->field($name);
		$f->value = $value;
		$f->changed = true;
		if(!($f->check = $check) || ($value === null && $f->isNullable()))
			return;
		if($value === null)
			$f->value = $f->default;
		settype($f->value, $f->type);
	}

	/**
	* Gets the value of a field given its name
	* @param String $name The field name
	* @return Mixed
	*/
	function get($name){
		$f = &$this->field($name);
		return $f->value;
	}

	/**
	* Returns a field reference given its name
	* @param String $name The field name
	* @return &TransferObjectField
	*/
	function &field($name){
		if(!$this->exists($name))
			trigger_error(__CLASS__ . '.' . __FUNCTION__ . ' Field "' . $name . '" not found');
		return $this->_fields[$name];
	}

	/**
	* Retrieves the field list
	* @return Array
	*/
	function fields(){
		return array_keys($this->_fields);
	}

	/**
	* Retrieves the key list
	* @return Array
	*/
	function keys(){
		$keys = array();
		foreach($this->_fields as $n=>$f)
			if($f->isKey())
				$keys[] = $n;
		return $keys;
	}

	/**
	* Gets the "SQL value" of a field given its name
	* @param String $name The field name
	* @return Mixed
	*/
	function SQLValue($name){
		$f = &$this->field($name);
		if(!$f->check)
			return $f->value;
		if($f->isNullable() && $f->value === null)
			return 'null';
		$x = $f->value === null ? $f->default : $f->value;
		return $f->type == 'string' ? "'" . str_replace('%', '\%', mysql_escape_string($x)) . "'" : $x;
	}

	/**
	* Check the fields looking for errors
	* @return Array
	*/
	function &getErrors(){
		$errors = array();
		foreach($this->_fields as $f){
			if(!$f->check)
				continue;
			$t = $f->basetype;
			if($f->type == 'integer' || $f->type == 'float'){
				if(!$f->isSigned() && $f->value < 0)
					$errors[] = array('field' => $f->name, 'code' => ERROR_ONLY_POSITIVE, 'message' => 'somente n�meros positivos');
			}
			elseif((($date = $t == 'date' ? !($time = 0) : ($t == 'time' ? !($time = 1) : ((($t == 'datetime' || $t == 'timestamp') && $time = 2) || $time = 0))) || $time) && !preg_match('/' . ($date ? '([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,2})' : '') . ($date && $time ? ' ?' : '') . ($time ? '(?:([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}))' . ($time == 2 ? '?' : '') : '') . '/', $f->value, $x) || ($date && !checkdate($x[2], $x[3], $x[1])) || (($time == 1 || ($time && count($x) == 7)) && ($x[1 + ($x[0] = count($x) == 7 ? 3 : 0)] > 23 || $x[2 + $x[0]] > 59 || $x[3 + $x[0]] > 59)))
				$errors[] = array('field' => $f->name, 'code' => ERROR_INVALID_DATETIME, 'message' => 'data/hora inv�lido');
			elseif($f->type == 'string' && strlen($f->value) > $f->length)
				$errors[] = array('field' => $f->name, 'code' => ERROR_INVALID_LENGTH, 'message' => 'deve conter no m�ximo ' . $f->length . ' caracteres');
		}
		return $errors;
	}

	/**
	* Checks if the given field exists
	* @param String $name The field name
	* @return Boolean
	*/
	function exists($name){
		return isset($this->_fields[$name]);
	}

	/**
	* Attempts to load a TransferObject given the relationship
	* @param String $class The DAO class name of the referenced table
	* @param Array $map An array mapping the relationship, the keys are fields contained in this DAO and the values are fields contained in the foreign DAO
	* @param TransferObject $to The TransferObject that will be used as "filter"
	* @return TranferObject or null if not found
	*/
	function &loadReference($class, $map, $to = null){
		$method = 'get' . $class;
		$dao = &DAOFactory::$method();
		$to || ($to = &$dao->create());
		foreach($map as $field=>$reference)
			$to->set($reference, $this->get($field));
		$to = &$dao->find($to);
		return $to;
	}

	/**
	* Attempts to load an array of TransferObjects given the relationship
	* @param String $class The DAO class name of the referenced table
	* @param Array $map An array mapping the relationship, the keys are fields contained in this DAO and the values are fields contained in the foreign DAO
	* @param TransferObject $to The TransferObject that will be used as "filter"
	* @param Integer $max = null Maximum amount of records that should be fetched
	* @param Integer $start = null Resultset offset
	* @param Array $order = array() Each element contains a fieldname followed by "desc" or "asc", the resultset will be ordered using the array order
	* @return TranferObject Null if not found
	*/
	function &listReferences($class, $map, $to = null, $max = null, $start = null, $order = null){
		$method = 'get' . $class;
		if(is_array($order))
			foreach($order as $i=>$v)
				$order[$i] = $this->_fields[strtok($v, ' ')]->field . (($v = strtok(' ')) ? ' ' . $v : '');
		$dao = &DAOFactory::$method();
		$to || ($to = &$dao->create());
		foreach($map as $field=>$reference)
			$to->set($reference, $this->get($field));
		$to = &$dao->selectTO($to, $max, $start, $order);
		return $to;
	}
}
?>