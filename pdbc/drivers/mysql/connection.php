<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: connection.php,v 1.0 2006/05/14 18:58:07
* @abstract MySQL Connection.
*/

require_once PDBC_INTERFACES . 'connection.php';

class MySQLConnection extends Connection{
	var $_catalog = '';
	var $_handle = null;
	var $_transactionLevel = TRANSACTION_REPEATABLE_READ;
	var $_holdability = HOLD_CURSORS_OVER_COMMIT;
	var $_autoCommit = true;
	var $_readOnly = false;
	var $_sqlWarning = null;
	var $_clientInfo = array();
	var $_statements = array();
	var $_prepared = array();
	var $_callable = array();

	function _errorCode(){
		return is_resource($this->_handle) ? mysql_errno($this->_handle) : mysql_errno();
	}

	function _errorMsg(){
		return is_resource($this->_handle) ? mysql_error($this->_handle) : mysql_error();
	}

	function _die($method = '', $context = '', $msg = ''){
		if(is_resource($this->_handle))
			die(__CLASS__ . ".$method: $context\n" . ($msg ? $msg : mysql_errno($this->_handle) . ' - ' . mysql_error($this->_handle)));
		else
			die(__CLASS__ . ".$method: $context\n" . ($msg ? $msg : mysql_errno() . ' - ' . mysql_error()));
	}

	function __destruct(){
		$this->close();
	}

	function &MySQLConnection($info){
		#$this->_transactionLevel = SELECT @@tx_isolation
		#$this->_autoCommit = SELECT @@autocommit
		$info['client-compress'] = empty($info['client-compress']) ? 0 : MYSQL_CLIENT_COMPRESS;
		$info['client-interactive'] = empty($info['client-interactive']) ? 0 : MYSQL_CLIENT_COMPRESS;
		$info['client-ignore-space'] = empty($info['client-ignore-space']) ? 0 : MYSQL_CLIENT_INTERACTIVE;
		$info['force-new-link'] = empty($info['force-new-link']) ? false : true;
		$this->_handle = @mysql_connect($info['host'], $info['user'], $info['password'], (boolean)$info['force-new-link'], $info['client-compress'] | $info['client-interactive'] | $info['client-ignore-space']);
		if(!$this->_handle){
			if($this->_errorCode() == 1045){
				require_once PDBC_EXCEPTIONS . 'sql-invalid-authorization-spec-exception.php';
				PDBCException::throwIt(new SQLInvalidAuthorizationSpecException($this->_errorMsg(), '', 1045));
				return $null;
			}
			require_once PDBC_EXCEPTIONS . 'sql-non-transient-connection-exception.php';
			PDBCException::throwIt(new SQLNonTransientConnectionException($this->_errorMsg(), '', $this->_errorCode()));
			return $null;
		}
		if(!empty($info['database'])){
			$this->setCatalog($info['database']);
			if($x = PDBCException::catchIt('SQLException')){
				PDBCException::throwIt($x);
				return $null;
			};
		}
		return $this;
	}

	function &createStatement($resultSetType = TYPE_FORWARD_ONLY, $resultSetConcurrency = CONCUR_READ_ONLY, $resultSetHoldability = null){
		require_once PDBC_MYSQL_DRIVER . 'statement.php';
		if(!$resultSetHoldability)
			$resultSetHoldability = $this->_holdability;
		$statement = &new MySQLStatement($this, $resultSetType, $resultSetConcurrency, $resultSetHoldability);
		$this->_statements[] = &$statement;
		return $statement;
	}

	function &prepareStatement($sql, $resultSetTypeOrAutoGen = TYPE_FORWARD_ONLY, $resultSetConcurrency = CONCUR_READ_ONLY, $resultSetHoldability = null){
		require_once PDBC_MYSQL_DRIVER . 'prepared-statement.php';
		if(func_num_args() == 2)
			return new MySQLPreparedStatement($this, $sql, $resultSetTypeOrAutoGen);
		if(!$resultSetHoldability)
			$resultSetHoldability = $this->_holdability;
		$prepared = &new MySQLPreparedStatement($this, $sql, $resultSetTypeOrAutoGen, $resultSetConcurrency, $resultSetHoldability);
		$this->_prepared[] = &$prepared;
		return $prepared;
	}

	function prepareCall($sql, $resultSetType = TYPE_FORWARD_ONLY, $resultSetConcurrency = CONCUR_READ_ONLY, $resultSetHoldability = null){
		require_once PDBC_MYSQL_DRIVER . 'callable-statement.php';
		if(!$resultSetHoldability)
			$resultSetHoldability = $this->_holdability;
		$callable = &new MySQLCallableStatement($this, $sql, $resultSetType, $resultSetConcurrency, $resultSetHoldability);
		$this->_callable[] = &$callable;
		return $callable;
	}

	function nativeSQL($sql){
		require_once PDBC_EXCEPTIONS . 'sql-feature-not-supported-exception.php';
		PDBCException::throwIt(new SQLFeatureNotSupportedException('nativeSQL isn\'t supported'));
	}

	function setAutoCommit($autoCommit){
		if($autoCommit != $this->_autoCommit)
			if(mysql_query('SET AUTOCOMMIT = ' . ($autoCommit ? '1' : '0'), $this->_handle))
				$this->_autoCommit = $autoCommit;
			else
				PDBCException::throwIt(new SQLException($this->_errorMsg(), '', $this->_errorCode()));
	}

	function getAutoCommit(){
		return $this->_autoCommit;
	}

	function commit(){
		if($this->_autoCommit)
			PDBCException::throwIt(new SQLException('Cannot commit with auto-commit turned on'));
		elseif(!mysql_query('COMMIT', $this->_handle))
			PDBCException::throwIt(new SQLException($this->_errorMsg(), '', $this->_errorCode()));
	}

	function rollback($savepoint = null){
		if($this->_autoCommit)
			PDBCException::throwIt(new SQLException('Cannot rollback with auto-commit turned on'));
		elseif(!mysql_query('ROLLBACK' . ($savepoint ? ' TO SAVEPOINT ' . $savepoint->getSavepointName() : ''), $this->_handle))
			PDBCException::throwIt(new SQLException($this->_errorMsg(), '', $this->_errorCode()));
	}

	function close(){
		if(!$this->isClosed()){
			if(!$this->_autoCommit)
				$this->rollback();
			for($i = count($this->_statements); $i; $this->_statements[--$i]->close());
			$this->_statements = array();

			for($i = count($this->_prepared); $i; $this->_prepared[--$i]->close());
			$this->_prepared = array();

			for($i = count($this->_callable); $i; $this->_callable[--$i]->close());
			$this->_callable = array();

			if(!mysql_close($this->_handle))
				PDBCException::throwIt(new SQLException($this->_errorMsg(), '', $this->_errorCode()));
		}
	}

	function isClosed(){
		return !is_resource($this->_handle);
	}

	function &getMetaData(){
		require_once PDBC_MYSQL_DRIVER . 'database-metadata.php';
		$dbmt = &new MySQLDatabaseMetaData($this);
		return $dbmt;
	}

	function setReadOnly($readOnly){
		if($readOnly != $this->_readOnly && !$this->_autoCommit)
			PDBCException::throwIt(new SQLException('Cannot change readOnly during a transaction'));
		else
			$this->_readOnly = $readOnly;
	}

	function isReadOnly(){
		return $this->_readOnly;
	}

	function setCatalog($catalog){
		if(!mysql_select_db($catalog, $this->_handle)){
			require_once PDBC_EXCEPTIONS . 'sql-non-transient-exception.php';
			return PDBCException::throwIt(new SQLNonTransientException($this->_errorMsg(), '', $this->_errorCode()));
		}
		$this->_catalog = $catalog;
	}

	function getCatalog(){
		return $this->_catalog;
	}

	function setTransactionIsolation($level){
		$s = '';
		if($level == TRANSACTION_READ_UNCOMMITTED)
			$s = 'READ UNCOMMITTED';
		elseif($level == TRANSACTION_READ_COMMITTED)
			$s = 'READ COMMITTED';
		elseif($level == TRANSACTION_REPEATABLE_READ)
			$s = 'REPEATABLE READ';
		elseif($level == TRANSACTION_SERIALIZABLE)
			$s = 'SERIALIZABLE';
		if($s){
			if(!mysql_query('SET SESSION TRANSACTION ISOLATION LEVEL ' . $s, $this->_handle))
				PDBCException::throwIt(new SQLException($this->_errorMsg(), '', $this->_errorCode()));
			else
				$this->_transactionLevel = $level;
		}
		else
			PDBCException::throwIt(new SQLException('Unrecognized transaction level'));
	}

	function getTransactionIsolation(){
		return $this->_transactionLevel;
	}

	function &getWarnings(){
		if($this->isClosed())
			PDBCException::throwIt(new SQLException('Cannot be called in a closed connection'));
		else
			return $this->_sqlWarning;
	}

	function clearWarnings(){
		unset($this->_sqlWarning);
		$this->_sqlWarning = null;
	}

	function &getTypeMap(){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	function setTypeMap(&$map){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}

	function setHoldability($holdability){
		if($holdability != HOLD_CURSORS_OVER_COMMIT && $holdability != CLOSE_CURSORS_AT_COMMIT)
			PDBCException::throwIt(new SQLException('Unrecognized holdability'));
		else
			$this->_holdability = $holdability;
	}

	function getHoldability(){
		return $this->_holdability;
	}

	function &setSavepoint($name = ''){
		static $id = 0;
		require_once PDBC_MYSQL_DRIVER . 'savepoint.php';
		if($this->_autoCommit){
			PDBCException::throwIt(new SQLException('Cannot be called with auto commit turned on'));
			return $null;
		}
		if($emptyName = !$name)
			$name = 'PDBC_SAVEPOINT_' . ++$id;
		if(!mysql_query('SAVEPOINT ' . $name, $this->_handle))
			PDBCException::throwIt(new SQLException($this->_errorMsg(), '', $this->_errorCode()));
		else{
			$savepoint = &new Savepoint($name);
			return $savepoint;
		}
	}

	function releaseSavepoint(&$savepoint){
		;
	}

	function &createClob(){
		require_once PDBC_MYSQL_DRIVER . 'clob.php';
		$clob = &new MySQLClob();
		return $clob;
	}

	function &createBlob(){
		require_once PDBC_MYSQL_DRIVER . 'blob.php';
		$blob = &new MySQLBlob();
		return $blob;
	}

	function &createNClob(){
		require_once PDBC_MYSQL_DRIVER . 'nclob.php';
		$nclob = &new MySQLNClob();
		return $nclob;
	}

	function &createSQLXML(){
		require_once PDBC_MYSQL_DRIVER . 'sql-xml.php';
		$SQLXML = &new MySQLSQLXML($this);
		return $SQLXML;
	}

	function isValid($timeout){
		if($timeout > 0)
			$start = time();
		return mysql_ping($this->_handle) && ($timeout > 0 ? $start + $timeout * 1e3 < time() : 1);
	}

	function setClientInfo($nameOrProperties, $value){
		if(is_array($nameOrProperties)){
			$this->_clientInfo = array();
			foreach($nameOrProperties as $name=>$value)
				$this->_clientInfo[$name] = $value;
		}
		else
			$this->_clientInfo[$nameOrProperties] = $value;
	}

	function getClientInfo($name = null){
		return !$name ? $this->_clientInfo : (empty($this->_clientInfo[$name]) ? '' : $this->_clientInfo[$name]);
	}

	function &createQueryObject($class){
		PDBCException::throwIt(new SQLException('Not implemented'));
	}
}
?>