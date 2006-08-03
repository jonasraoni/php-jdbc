<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: resultset.php,v 1.0 2006/05/14 18:58:07
* @abstract MySQL ResultSet
*/

require_once PDBC_INTERFACES . 'resultset.php';

class MySQLResultSet extends ResultSet{
	var $_curRow = 0;
	var $_rowCount = 0;
	var $_wasNull = false;
	var $_isInsertRow = false;
	var $_row = array();
	var $_columns = array();
	var $_inserted = array();
	var $_deleted = array();
	var $_updated = array();
	var $_handle = null;
	var $_statement = null;
	var $_SQLWarning = null;
	var $_query = null;
	var $_fetchDirection = null;
	var $_fetchSize = null;

	function _parseDate($date){
		if(preg_match('/(\d{4})-(\d{2})-(\d{2})/', $date, $match))
			$date = array($match[2], $match[3], $match[1]);
		elseif(preg_match('/(\d{1,2})\\/(\d{1,2})\\/(\d{2,4})/', $date, $match))
			$date = array(0, 0, 0, $match[1], $match[2], $match[3]);
		else
			$date = array(0, 0, 0);
		if(preg_match('/(\d{2}):(\d{2}):(\d{2})/', $date, $match))
			$time = array($match[1], $match[2], $match[3]);
		else
			$time = array(0, 0, 0);
		return mktime($time[0], $time[1], $time[2], $date[1], $date[2], $time[0]);
	}

	function _get($column){
		if(($x = $this->_row[(is_int($column) ? $column : $this->findColumn($column)) - 1]) === null)
			$this->_wasNull = true;
		return $x;
	}

	function _set($column, $value){
		$this->_row[(is_int($column) ? $column : $this->findColumn($column)) - 1] = $value;
	}

	function _setRef($column, &$value){
		$this->_row[(is_int($column) ? $column : $this->findColumn($column)) - 1] = $value;
	}

	function &MySQLResultSet(&$statement, $result, $fetchDirection, $fetchSize){
		$this->_statement = &$statement;
		$this->_handle = $statement->_connection->_handle;
		$this->_query = $result;
		$this->_rowCount = mysql_num_rows($result);
		$this->setFetchDirection($fetchDirection);
		$this->setFetchSize($fetchSize);
		for($i = mysql_num_fields($result); $i--;)
			$this->_columns[mysql_field_name($result, $i)] = $i;
		return $this;
	}

	function next(){
		$this->clearWarnings();
		$this->wasNull = false;
		if($this->_row = @mysql_fetch_row($this->_query))
			return !!++$this->_curRow;
		else
			return !($this->_curRow = $this->_rowCount + 1);

	}

	function close(){
		if(is_resource($this->_query) && !mysql_free_result($this->_query))
			PDBCException::throwIt(new SQLException('Error while freeing up the result'));
		else{
			$this->_curRow = -1;
			$this->_row = array();
		}
	}

	function wasNull(){
		return $this->_wasNull;
	}

	function absolute($row){
		if($this->getType() == TYPE_FORWARD_ONLY)
			return PDBCException::throwIt(new SQLException('This cannot be called on a forward only result set'));
		if(!$this->_rowCount)
			return false;
		$row < 0 ? ($row = $this->_rowCount + $row) : --$row;
		$callNext = ($diff = 0) + 1;
		if($row < 0){
			$row = $callNext = 0;
			$this->_row = array();
		}
		elseif($row >= $this->_rowCount)
			$row = $this->_rowCount - ($diff = !!$this->_rowCount);
		$this->_curRow = $row + $diff;
		@mysql_data_seek($this->_query, $row);
		if($callNext)
			$this->next();
		return $this->_curRow > 0 && $this->_curRow < $this->_rowCount + 1;
	}

	function afterLast(){
		if($this->getType() == TYPE_FORWARD_ONLY)
			PDBCException::throwIt(new SQLException('This cannot be called on a forward only result set'));
		else
			$this->absolute($this->_rowCount + 1);
	}

	function beforeFirst(){
		if($this->getType() == TYPE_FORWARD_ONLY)
			PDBCException::throwIt(new SQLException('This cannot be called on a forward only result set'));
		else
			$this->absolute(0);
	}

	function cancelRowUpdates(){
		if($this->_isInsertRow)
			return PDBCException::throwIt(new SQLException('Cannot be called inside an insert row'));
		$this->_doRefreshRow($this->_row);
		PDBCException::throwIt(new SQLException('TO FINISH'));
	}

	function clearWarnings(){
		unset($this->_SQLWarning);
		$this->_SQLWarning = null;
	}

	function deleteRow(){
		if($this->_isInsertRow)
			return PDBCException::throwIt(new SQLException('Cannot be called inside an insert row'));
		$this->_deleted[$this->_curRow] = true;
		PDBCException::throwIt(new SQLException('TO FINISH'));
	}

	function findColumn($columnName){
		if(!isset($this->_columns[$columnName]))
			PDBCException::throwIt(new SQLException('Column ' . $columnName . ' wasn\'t found'));
		else
			return $this->_columns[$columnName] + 1;
	}

	function first(){
		return $this->absolute(1);
	}

	function getConcurrency(){
		return $this->_statement->getResultSetConcurrency();
	}

	function getCursorName(){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function getFetchDirection(){
		return $this->_fetchDirection;
	}

	function getFetchSize(){
		return $this->_fetchSize;
	}

	function getHoldability(){
		return $this->_statement->getResultSetHoldability();
	}

	function &getMetaData(){
		require_once PDBC_MYSQL_DRIVER . 'resultset-metadata.php';
		$metadata = &new MySQLResultSetMetaData($this);
		return $metadata;
	}

	function getRow(){
		return $this->_curRow;
	}

	function &getStatement(){
		return $this->_statement;
	}

	function getType(){
		return $this->_statement->getResultSetType();
	}

	function &getWarnings(){
		if($this->isClosed())
			PDBCException::throwIt(new SQLException('Cannot be called on a closed result set'));
		else
			return $this->_SQLWarning;
	}

	function insertRow(){
		if(!$this->_isInsertRow)
			return PDBCException::throwIt(new SQLException('Cannot be called outside of an insert row'));
		foreach($this->_columns as $index=>$col)
			if(!$col['nullable'] && $this->_row[$index] === null)
				return PDBCException::throwIt(new SQLException('A non-nullable fields is blank'));
		PDBCException::throwIt(new SQLException('TO FINISH'));

	}

	function isAfterLast(){
		return $this->_rowCount && $this->_curRow == $this->_rowCount + 1;
	}

	function isBeforeFirst(){
		return $this->_rowCount && $this->_curRow == 0;
	}

	function isClosed(){
		return is_resource($this->_query);
	}

	function isFirst(){
		return $this->_rowCount && $this->_curRow == 1;
	}

	function isLast(){
		return $this->_rowCount && $this->_curRow == $this->_rowCount;
	}

	function last(){
		return $this->absolute(-1);
	}

	function moveToCurrentRow(){
		$this->_isInsertRow = false;
		$this->absolute($this->_curRow);
	}

	function moveToInsertRow(){
		$this->_isInsertRow = true;
		$this->_row = array();
	}

	function previous(){
		return $this->relative(-1);
	}

	function refreshRow(){
		if($this->_isInsertRow)
			return PDBCException::throwIt(new SQLException('Cannot be called inside an insert row'));
		PDBCException::throwIt(new SQLException('TO FINISH'));
	}

	function relative($rows){
		return $this->absolute($this->_curRow + $rows);
	}

	function rowDeleted(){
		if(isset($this->_deleted[$this->_curRow]))
			return true;
		return !$this->_doRefreshRow($row);
	}

	function rowInserted(){
		return isset($this->_inserted[$this->_curRow]);
	}

	function rowUpdated(){
		if(isset($this->_updated[$this->_curRow]))
			return true;
		if(!$this->_doRefreshRow($row))
			return true;
		foreach($this->_columns as $index=>$col)
			if($row[$index] != $this->_row[$index])
				return true;
		return false;
	}

	function setFetchDirection($direction){
		if($direction != FETCH_FORWARD && $direction != FETCH_REVERSE && $direction != FETCH_UNKNOWN)
			return PDBCException::throwIt(new SQLException('Unrecognized fetch direction'));
		if($this->getType() == TYPE_FORWARD_ONLY && $direction != FETCH_FORWARD)
			return PDBCException::throwIt(new SQLException('This cannot be called on a forward only result set'));
		$this->_fetchDirection = $direction;
	}

	function setFetchSize($rows){
		if($rows < 0)
			return PDBCException::throwIt(new SQLException('Invalid value for the rows argument'));
		$this->_fetchSize = $rows;
	}

	function updateRow(){
		if($this->_isInsertRow)
			return PDBCException::throwIt(new SQLException('Cannot be called inside an insert row'));
		$this->_updated[$this->_curRow] = true;
		PDBCException::throwIt(new SQLException('TO FINISH'));
	}

	function getArray($column){
		return $this->_get($column);
	}

	function &getAsciiStream($column){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function &getBigDecimal($column){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function &getBinaryStream($column){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function &getBlob($column){
		return $this->_get($column);
	}

	function getBoolean($column){
		return (bool)$this->_get($column);
	}

	function getByte($column){
		return (int)$this->_get($column);
	}

	function getBytes($column){
		$result = array();
		$x = $this->_get($column);
		if(is_numeric($x)){
			$x = str_split(dechex((int)$x));
			$i = -1;
			$hex = '';
			foreach($x as $c){
				$hex .= $c;
				if(++$i % 2){
					$result[] = hexdec($hex);
					$hex = '';
				}
			}
			if($hex)
				$result[] = hexdec($hex);
		}
		else
			foreach(str_split($x) as $c)
				$result[] = ord($c);
		return $result;
	}

	function &getCharacterStream($column){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function &getClob($column){
		return $this->_get($column);
	}

	function &getDate($column){
		$date = &new Date($this->_parseDate($this->_get($column)));
		return $date;
	}

	function getDouble($column){
		return (float)$this->_get($column);
	}

	function getFloat($column){
		return (float)$this->_get($column);
	}

	function getInt($column){
		return (int)$this->_get($column);
	}

	function getLong($column){
		return (int)$this->_get($column);
	}

	function &getNCharacterStream($column){
		return $this->_get($column);
	}

	function &getNClob($column){
		return $this->_get($column);
	}

	function getNString($column){
		return $this->_get($column);
	}

	function &getObject($column, $map = null){
		return $this->_get($column);
	}

	function &getRef($column){
		return $this->_get($column);
	}

	function &getRowId($column){
		return $this->_get($column);
	}

	function getShort($column){
		return (int)$this->_get($column);
	}

	function &getSQLXML($column){
		return $this->_get($column);
	}

	function getString($column){
		return $this->_get($column);
	}

	function &getTime($column){
		$time = &new Time($this->_parseDate($this->_get($column)));
		return $time;
	}

	function &getTimestamp($column){
		$timestamp = &new Timestamp($this->_parseDate($this->_get($column)));
		return $timestamp;
	}

	function &getURL($column){
		return $this->_get($column);
	}

	function updateArray($column, $value){
		$this->_set($column, $value);
	}

	function updateAsciiStream($column, &$value, $length){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function updateBigDecimal($column, &$value){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function updateBinaryStream($column, &$value, $length){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function updateBlob($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateBoolean($column, $value){
		$this->_set($column, (bool)$value);
	}

	function updateByte($column, $value){
		$this->_set($column, (int)$value);
	}

	function updateBytes($column, $value){
		$this->_set($column, $value);
	}

	function updateCharacterStream($column, &$value, $length){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function updateClob($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateDate($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateDouble($column, $value){
		$this->_set($column, (float)$value);
	}

	function updateFloat($column, $value){
		$this->_set($column, (float)$value);
	}

	function updateInt($column, $value){
		$this->_set($column, (int)$value);
	}

	function updateLong($column, $value){
		$this->_set($column, (int)$value);
	}

	function updateNCharacterStream($column, &$value, $length){
		PDBCException::throwIt(new SQLException('Not available'));
	}

	function updateNClob($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateNString($column, $value){
		$this->_set($column, (string)$value);
	}

	function updateNull($column){
		$this->_set($column, null);
	}

	function updateObject($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateRef($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateRowId($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateShort($column, $value){
		$this->_set($column, (int)$value);
	}

	function updateSQLXML($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateString($column, $value){
		$this->_set($column, (string)$value);
	}

	function updateTime($column, &$value){
		$this->_setRef($column, $value);
	}

	function updateTimestamp($column, &$value){
		$this->_setRef($column, $value);
	}
}
?>