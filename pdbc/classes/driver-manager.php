<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: driver-manager.php,v 1.0 2006/05/09 17:36:00
* @abstract The basic service for managing a set of PDBC drivers.
*/

/* Class properties emulation */
$GLOBALS['DriverManager_logger'] = null;
$GLOBALS['DriverManager_drivers'] = array();
$GLOBALS['DriverManager_timeout'] = 0;

class DriverManager{
	function DriverManager(){
		trigger_error(__CLASS__ . ' doesn\'t have constructor.', E_USER_ERROR);
	}

	/**
	* Retrieves the log writer.
	* @return PrintWriter
	*/
	function &getLogWriter(){
		return $GLOBALS['DriverManager_logger'];
	}

	/**
	* Sets the logging/tracing PrintWriter object that is used by the DriverManager and all drivers
	* @param PrintWriter $logger
	* @return void
	*/
	function setLogWriter(&$logger){
		$_logger = &$GLOBALS['DriverManager_logger'];
		if(is_a($logger, 'PrintWriter'))
			$_logger = &$logger;
		elseif($logger === null)
			$_logger = null;
	}

	/**
	* Attempts to establish a connection to the given database URL.
	* @param String $url
	* @param Properties/String $infoOrUser
	* @param String $password
	* @throw SQLException
	* @return Connection
	*/
	function &getConnection($url, $infoOrUser = array(), $password = ''){
		if($_timeout = &$GLOBALS['DriverManager_timeout'])
			$start = mktime();
		if(is_object($driver = &DriverManager::getDriver($url))){
			if(func_num_args() == 3)
				$infoOrUser = array('user' => $infoOrUser, 'password' => $password);
			$connection = &$driver->connect($url, $infoOrUser);
			if($_timeout && $start + $_timeout < time()){
				require_once PDBC_EXCEPTIONS . 'sql-timeout-exception.php';

				PDBCException::throwIt(new SQLTimeoutException('Connection timed out'));
				return $null;
			}
			return $connection;
		}
		return $null;
	}

	/**
	* Attempts to locate a driver that understands the given URL.
	* @param String $url
	* @throw SQLException
	* @return Driver
	*/
	function &getDriver($url){
		$_drivers = &$GLOBALS['DriverManager_drivers'];
		foreach($_drivers as $driver=>$o)
			if($o->acceptsURL($url))
				return $_drivers[$driver];
		return $null;
	}

	/**
	* Registers the given driver with the DriverManager
	* @param Driver $driver
	* @throw SQLException
	* @return void
	*/
	function registerDriver(&$driver){
		$GLOBALS['DriverManager_drivers'][get_class($driver)] = &$driver;
	}

	/**
	* Drops a driver from the DriverManager's list
	* @param Driver $driver
	* @throw SQLException
	* @return void
	*/
	function deregisterDriver(&$driver){
		unset($GLOBALS['DriverManager_drivers'][get_class($driver)]);
	}

	/**
	* Retrieves an Enumeration with all of the currently loaded JDBC drivers to which the current caller has access
	* @return Driver[]
	*/
	function getDrivers(){
		return array_values($GLOBALS['DriverManager_drivers']);
	}

	/**
	* Sets the maximum time in seconds that a driver will wait while attempting to connect to a database
	* @param Integer $timeout
	* @return void
	*/
	function setLoginTimeout($timeout){
		$GLOBALS['DriverManager_timeout'] = $timeout;
	}

	/**
	* Gets the maximum time in seconds that a driver can wait when attempting to log in to a database
	* @return Integer
	*/
	function getLoginTimeout(){
		return $GLOBALS['DriverManager_timeout'];
	}

	/**
	* Prints a message to the current JDBC log stream
	* @param String $message
	* @return void
	*/
	function println($message){
		$_logger = $GLOBALS['DriverManager_logger'];
		$_logger->println($message);
	}
}
?>