<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: resultset-metadata.php,v 1.0 2006/05/09 18:58:07
* @abstract An object that can be used to get information about the types and properties of the columns in a ResultSet object
*/

require_once PDBC_INTERFACES . 'resultset-metadata.php';

class MySQLResultSetMetaData extends ResultSetMetaData{
	var $_resultset = null;
	var $_fields = array();
	var $_fieldnames = array();
	var $_tables = array();
	var $_query = null;

	/**
	* Class constructor
	* @param ResultSet $resultset
	*/
	function &MySQLResultSetMetaData(&$resultset){
		$this->_resultset = &$resultset;
		$this->_query = $this->_resultset->_query;
		for($i = mysql_num_fields($this->_query); $i--;){
			$field = &$this->_fields[$i];
			$field = mysql_fetch_field($this->_query, $i);
			$field->length = mysql_field_len($this->_query, $i);
			$field->flags = array_flip(explode(' ', mysql_field_flags($this->_query, $i)));
			$field->length == -1 && $field->blob && ($field->length = 4294967295);
			$field->type == 'unknown' && ($field->type = 'numeric');
			$this->_tables[$field->table] = 1;
		}
		return $this;
	}

	/**
	* Gets the designated column's table's catalog name
	* @param Integer $column
	* @return String
	*/
	function getCatalogName($column){
		# =/
		return $this->_resultset->_statement->_connection->getCatalog();
	}

	/**
	* Returns the fully-qualified name of the Java class whose instances are manufactured if the method ResultSet.getObject is called to retrieve a value from the column
	* @param Integer $column
	* @return String
	*/
	function getColumnClassName($column){
		$classes = array(
			VARCHAR => '',
			BLOB => 'Blob',
			CLOB => 'Clob',
			DOUBLE => '',
			NUMERIC => '',
			TINYINT => '',
			SMALLINT => '',
			INTEGER => '',
			BIGINT => '',
			DATE => 'Date',
			TIMESTAMP => 'Timestamp',
			TIME => 'Time',
			OTHER => ''
		);
		$type = $this->getColumnType($column);
		return isset($classes[$type]) ? $classes[$sqlType] : '';
	}

	/**
	* Returns the number of columns in this ResultSet object
	* @param Integer $column
	* @return Integer
	*/
	function getColumnCount(){
		return count($this->_fields);
	}

	/**
	* Indicates the designated column's normal maximum width in characters
	* @param Integer $column
	* @return Integer
	*/
	function getColumnDisplaySize($column){
		return $this->_fields[$column - 1]->max_length;
	}

	/**
	* Gets the designated column's suggested title for use in printouts and displays
	* @param Integer $column
	* @return String
	*/
	function getColumnLabel($column){
		return $this->_fields[$column - 1]->name;
	}

	/**
	* Get the designated column's name
	* @param Integer $column
	* @return String
	*/
	function getColumnName($column){
		return $this->_fields[$column - 1]->name;
	}

	/**
	* Retrieves the designated column's SQL type
	* @param Integer $column
	* @return Integer
	*/
	function getColumnType($column){
		$codes = array(
			'varchar' => VARCHAR,
			'tinyblob' => BLOB, 'blob' => BLOB, 'mediumblob' => BLOB, 'longblob' => BLOB,
			'tinytext' => CLOB, 'text' => CLOB, 'mediumtext' => CLOB, 'longtext' => CLOB,
			'double' => DOUBLE,
			'numeric' => NUMERIC,
			'tinyint' => TINYINT, 'smallint' => SMALLINT, 'mediumint' => INTEGER, 'int' => INTEGER, 'bigint' => BIGINT,
			'date' => DATE, 'datetime' => DATE, 'timestamp' => TIMESTAMP, 'time' => TIME, 'year' => INTEGER
		);
		$sqlType = $this->getColumnTypeName($column);
		return isset($codes[$sqlType]) ? $codes[$sqlType] : OTHER;
	}

	/**
	* Retrieves the designated column's database-specific type name
	* @param Integer $column
	* @return String
	*/
	function getColumnTypeName($column){
		$f = &$this->_fields[$column - 1];
		if($f->type == 'string')
			return 'varchar';
		elseif($f->blob)
			return ($f->length < 256 ? 'tiny' : ($f->length < 65536 ? '' : ($f->length < 16777216 ? 'medium' : 'long'))) . (isset($f->flags['binary']) ? 'blob' : 'text');
		#elseif($f->type == 'int')
		#	return ($f->length == 1 ? 'tiny' : ($f->length == 2 ? 'small' : ($f->length == 3 ? 'medium' : ($f->length == 4 ? '' : 'big')))). 'int';
		elseif($f->type == 'real')
			return 'double';
		else
			return strtolower($f->type);
	}

	/**
	* Get the designated column's specified column size
	* @param Integer $column
	* @return Integer
	*/
	function getPrecision($column){
		return $this->_fields[$column - 1]->length;
	}

	/**
	* Gets the designated column's number of digits to right of the decimal point
	* @param Integer $column
	* @return Integer
	*/
	function getScale($column){
		return 0;
	}

	/**
	* Get the designated column's table's schema
	* @param Integer $column
	* @return String
	*/
	function getSchemaName($column){
		return '';
	}

	/**
	* Gets the designated column's table name
	* @param Integer $column
	* @return String
	*/
	function getTableName($column){
		return $this->_fields[$column - 1]->table;
	}

	/**
	* Indicates whether the designated column is automatically numbered
	* @param Integer $column
	* @return Boolean
	*/
	function isAutoIncrement($column){
		return isset($this->_fields[$column - 1]->flags['auto_increment']);
	}

	/**
	* Indicates whether a column's case matters
	* @param Integer $column
	* @return Boolean
	*/
	function isCaseSensitive($column){
		$field = &$this->_fields[$column - 1];
		return $field->type != 'string' ? true : isset($field->flags['binary']) && !isset($field->flags['enum']) && !isset($field->flags['set']);
	}

	/**
	* Indicates whether the designated column is a cash value
	* @param Integer $column
	* @return Boolean
	*/
	function isCurrency($column){
		return false;
	}

	/**
	* Indicates whether a write on the designated column will definitely succeed
	* @param Integer $column
	* @return Boolean
	*/
	function isDefinitelyWritable($column){
		return !$this->isReadOnly($column) && count($this->_tables) == 1;
	}

	/**
	* Indicates the nullability of values in the designated column
	* @param Integer $column
	* @return Integer
	*/
	function isNullable($column){
		return !$this->_fields[$column - 1]->not_null;
	}

	/**
	* Indicates whether the designated column is definitely not writable
	* @param Integer $column
	* @return Boolean
	*/
	function isReadOnly($column){
		$handle = $this->_resultset->_statement->_connection->_handle;
		$field = $this->getColumnName($column);
		$table = $this->getTableName($column);
		if(is_resource($q = mysql_query('select ' . $field . ' from ' . $table . ' limit 1', $handle))){
			mysql_free_result($q);
			return false;
		}
		return true;
	}

	/**
	* Indicates whether the designated column can be used in a where clause
	* @param Integer $column
	* @return Boolean
	*/
	function isSearchable($column){
		return !$this->_fields[$column - 1]->blob;
	}

	/**
	* Indicates whether values in the designated column are signed numbers
	* @param Integer $column
	* @return Boolean
	*/
	function isSigned($column){
		return $this->_fields[$column - 1]->numeric && !isset($this->_fields[$column - 1]->flags['unsigned']);
	}

	/**
	* Indicates whether it is possible for a write on the designated column to succeed
	* @param Integer $column
	* @return Boolean
	*/
	function isWritable($column){
		return !$this->isReadOnly($column);
	}
}
?>