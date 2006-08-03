<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: dao-factory.php,v 1.0 <dao:date>2006/05/24 15:36:00</dao:date>
* @abstract Retrieves DAO objects and manages the connection
*/

define('DAO_BASE_DIR', dirname(__FILE__) . '/');

/* Class property emulation */
global $DAOFactoryConnection;

class DAOFactory{
	/**
	* Retrieves a new connection and reuses it on subsequent calls
	* @return Connection
	*/
	function &createConnection(){
		require_once DAO_BASE_DIR . 'pdbc/pdbc.php';
		require_once PDBC_DRIVERS . 'mysql.php';

		$url = '<dao:url>mysql://host/database</dao:url>';
		$user = '<dao:user>root</dao:user>';
		$password = '<dao:password>root</dao:password>';
		if(!$GLOBALS['DAOFactoryConnection'])
			$GLOBALS['DAOFactoryConnection'] = &DriverManager::getConnection($url, $user, $password);
		return $GLOBALS['DAOFactoryConnection'];
	}<dao:method>
	/**
	* Retrieves a new <dao:name>Table</dao:name>DAO object
	* @return <dao:name>Table</dao:name>DAO
	*/
	function &get<dao:name>Table</dao:name>DAO(){
		require_once DAO_BASE_DIR . 'data-access/<dao:path>table</dao:path>.php';
		$dao = &new <dao:name>Table</dao:name>DAO;
		return $dao;
	}
</dao:method>}
?>