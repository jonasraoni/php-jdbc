<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: query-object-generator.php,v 1.0 2006/05/09 18:58:07
* @abstract This interface is provided for JDBC driver vendors who choose to provide their own implementation of QueryObjectGenerator to process the standard JDBC annotations and provide the mapping between a DataSet and the underlying data store
*/

class QueryObjectGenerator{
	/**
	*  Creates a concrete implementation of a Query interface using the JDBC drivers QueryObjectGenerator implementation
	* @param Interface $ifc
	* @param Connection $con
	* @return BaseQuery
	*/
	function createQueryObject($ifc, $con){
		die('Not implemented');
	}
}
?>