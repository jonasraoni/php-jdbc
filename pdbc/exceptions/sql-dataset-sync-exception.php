<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-dataset-sync-exception.php,v 1.0 2006/05/20 18:58:07
* @abstract The subclass of SQLRuntimeException thrown when an invocation of the sync method for a disconnected DataSet fails
*/

require_once PDBC_EXCEPTIONS . 'sql-runtime-exception.php';

class SQLDataSetSyncException extends SQLRuntimeException{
	/* The working dataset */
	var $_dataset = null;

	/**
	* Constructor
	* @param String $message The exception cause
	* @param &$dataset The dataset whose method sync failed
	*/
	function SQLDataSetSyncException($message = '', &$dataset){
		parent::SQLRuntimeException($message);
		$this->_dataset = &$dataset;
	}

	/**
	* Retrieves a DataSetResolver object that contains the rows that could not be propagated to the underlying data source by calling the sync method on a disconnected DataSet
	* @return DataSetResolver
	*/
	function &getDataSetResolver(){

	}
}
?>
