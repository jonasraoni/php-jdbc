<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: connection.php,v 1.0 2006/05/09 18:58:07
* @abstract A connection with a specific database. SQL statements are executed and results are returned within the context of a connection
*/

class Connection{
	/**
	* Class constructor
	* @param Properties $info
	*/
	function &MySQLConnection($info){
		die('Not implemented');
	}

	/**
	* Creates a Statement object that will generate ResultSet objects with the given type, concurrency, and holdability
	* @param Integer $resultSetType
	* @param Integer $resultSetConcurrency
	* @param Integer $resultSetHoldability
	* @throw SQLException
	* @return Statement
	*/
	function &createStatement($resultSetType = TYPE_FORWARD_ONLY, $resultSetConcurrency = CONCUR_READ_ONLY, $resultSetHoldability = null){
		die('Not implemented');
	}

	/**
	* Creates a PreparedStatement object that will generate ResultSet objects with the given type, concurrency, and holdability
	* Creates a default PreparedStatement object that has the capability to retrieve auto-generated keys
	* Creates a default PreparedStatement object capable of returning the auto-generated keys designated by the given array of field names/indexes
	* @param String $sql
	* @param Integer/String[]/Integer[] $resultSetTypeOrAutoGen
	* @param Integer $resultSetConcurrency
	* @param Integer $resultSetHoldability
	* @throw SQLException
	* @return PreparedStatement
	*/
	function &prepareStatement($sql, $resultSetTypeOrAutoGen = TYPE_FORWARD_ONLY, $resultSetConcurrency = CONCUR_READ_ONLY, $resultSetHoldability = null){
		die('Not implemented');
	}

	/**
	* Creates a CallableStatement object that will generate ResultSet objects with the given type and concurrency
	* @param String $sql
	* @param Integer $resultSetType
	* @param Integer $resultSetConcurrency
	* @param Integer $resultSetHoldability
	* @throw SQLException
	* @return CallableStatement
	*/
	function prepareCall($sql, $resultSetType = TYPE_FORWARD_ONLY, $resultSetConcurrency = CONCUR_READ_ONLY, $resultSetHoldability = null){
		die('Not implemented');
	}

	/**
	* Converts the given SQL statement into the system's native SQL grammar
	* @param String $sql
	* @throw SQLException
	* @return String
	*/
	function nativeSQL($sql){
		die('Not implemented');
	}

	/**
	* Sets this connection's auto-commit mode to the given state
	* @param Boolean $autoCommit
	* @throw SQLException
	* @return void
	*/
	function setAutoCommit($autoCommit){
		die('Not implemented');
	}

	/**
	* Retrieves the current auto-commit mode for this Connection object
	* @throw SQLException
	* @return Boolean
	*/
	function getAutoCommit(){
		die('Not implemented');
	}

	/**
	* Makes all changes made since the previous commit/rollback permanent and releases any database locks currently held by this Connection object
	* @throw SQLException
	* @return void
	*/
	function commit(){
		die('Not implemented');
	}

	/**
	* Undoes all changes made in the current transaction and releases any database locks currently held by this Connection object
	* Undoes all changes made after the given Savepoint object was set
	* @param Savepoint $savepoint
	* @throw SQLException
	* @return void
	*/
	function rollback($savepoint = null){
		die('Not implemented');
	}

	/**
	* Releases this Connection object's database and JDBC resources immediately instead of waiting for them to be automatically released
	* @throw SQLException
	* @return void
	*/
	function close(){
		die('Not implemented');
	}

	/**
	* Retrieves whether this Connection object has been closed
	* @throw SQLException
	* @return Boolean
	*/
	function isClosed(){
		die('Not implemented');
	}

	/**
	* Retrieves a DatabaseMetaData object that contains metadata about the database to which this Connection object represents a connection
	* @throw SQLException
	* @return DatabaseMetaData
	*/
	function &getMetaData(){
		die('Not implemented');
	}

	/**
	* Puts this connection in read-only mode as a hint to the driver to enable database optimizations
	* @param Boolean $readOnly
	* @throw SQLException
	* @return void
	*/
	function setReadOnly($readOnly){
		die('Not implemented');
	}

	/**
	* Retrieves whether this Connection object is in read-only mode
	* @throw SQLException
	* @return Boolean
	*/
	function isReadOnly(){
		die('Not implemented');
	}

	/**
	* Sets the given catalog name in order to select a subspace of this Connection object's database in which to work
	* @param String $catalog
	* @throw SQLException
	* @return void
	*/
	function setCatalog($catalog){
		die('Not implemented');
	}

	/**
	* Retrieves this Connection object's current catalog name
	* @throw SQLException
	* @return String
	*/
	function getCatalog(){
		die('Not implemented');
	}

	/**
	* Attempts to change the transaction isolation level for this Connection object to the one given
	* @param Integer $level
	* @throw SQLException
	* @return void
	*/
	function setTransactionIsolation($level){
		die('Not implemented');
	}

	/**
	* Retrieves this Connection object's current transaction isolation level
	* @throw SQLException
	* @return Integer
	*/
	function getTransactionIsolation(){
		die('Not implemented');
	}

	/**
	* Retrieves the first warning reported by calls on this Connection object
	* @throw SQLException
	* @return SQLWarning
	*/
	function &getWarnings(){
		die('Not implemented');
	}

	/**
	* Clears all warnings reported for this Connection object
	* @throw SQLException
	* @return void
	*/
	function clearWarnings(){
		die('Not implemented');
	}

	/**
	* Retrieves the Map object associated with this Connection object
	* @throw SQLException
	* @return Map
	*/
	function &getTypeMap(){
		die('Not implemented');
	}

	/**
	* Installs the given TypeMap object as the type map for this Connection object
	* @throw SQLException
	* @param Map $map
	*/
	function setTypeMap(&$map){
		die('Not implemented');
	}

	/**
	* Changes the default holdability of ResultSet objects created using this Connection object to the given holdability
	* @param Integer $holdability
	* @throw SQLException
	* @return void
	*/
	function setHoldability($holdability){
		die('Not implemented');
	}

	/**
	* Retrieves the current holdability of ResultSet objects created using this Connection object
	* @throw SQLException
	* @return Integer
	*/
	function getHoldability(){
		die('Not implemented');
	}

	/**
	* Creates a savepoint with the given name in the current transaction and returns the new Savepoint object that represents it
	* @param String $name
	* @throw SQLException
	* @return Savepoint
	*/
	function &setSavepoint($name = ''){
		die('Not implemented');
	}

	/**
	* Removes the specified Savepoint and subsequent Savepoint objects from the current transaction
	* @param Savepoint $savepoint
	* @throw SQLException
	* @return void
	*/
	function releaseSavepoint(&$savepoint){
		die('Not implemented');
	}

	/**
	* Constructs an object that implements the Clob interface
	* @throw SQLException
	* @return Clob
	*/
	function &createClob(){
		die('Not implemented');
	}

	/**
	* Constructs an object that implements the Blob interface
	* @throw SQLException
	* @return Blob
	*/
	function &createBlob(){
		die('Not implemented');
	}

	/**
	* Constructs an object that implements the NClob interface
	* @throw SQLException
	* @return NClob
	*/
	function &createNClob(){
		die('Not implemented');
	}

	/**
	* Constructs an object that implements the SQLXML interface
	* @throw SQLException
	* @return SQLXML
	*/
	function &createSQLXML(){
		die('Not implemented');
	}

	/**
	* Returns true if the connection has not been closed and is still valid
	* @param Integer $timeout
	* @throw SQLException
	* @return Boolean
	*/
	function isValid($timeout){
		die('Not implemented');
	}

	/**
	* Sets the value of the client info property specified by name to the value specified by value
	* @param String/Array $nameOrProperties
	* @param String $value
	* @throw SQLException/ClientInfoException
	* @return void
	*/
	function setClientInfo($nameOrProperties, $value){
		die('Not implemented');
	}

	/**
	* Returns the value of the client info property specified by name
	* @param String $name
	* @throw SQLException
	* @return String/Array
	*/
	function getClientInfo($name = null){
		die('Not implemented');
	}

	/**
	* Creates a concrete implementation of a Query interface using the PDBC drivers QueryObjectGenerator implementation
	* @param $class
	* @throw SQLException
	* @return BaseQuery
	*/
	function &createQueryObject($class){
		die('Not implemented');
	}
}
?>