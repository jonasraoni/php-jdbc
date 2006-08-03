<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: driver.php,v 1.0 2006/05/13 17:37:50
* @abstract MySQL Driver
*/

require_once PDBC_INTERFACES . 'driver.php';

class MySQLDriver extends Driver{
	function &connect($url, $info){
		if(!$this->acceptsURL($url))
			return $null;
		$url = substr($url, strlen('mysql://'));
		$pos = strrpos($url, '/');
		$info['host'] = substr($url, 0, $pos);
		$info['database'] = substr($url, $pos + 1);

		require_once PDBC_MYSQL_DRIVER . 'connection.php';
		$connection = &new MySQLConnection($info);
		return $connection;
	}

	function acceptsURL($url){
		$match = 'mysql://';
		return substr($url, 0, strlen($match)) == $match;
	}

	function &getPropertyInfo(&$url, $info){
		require_once PDBC_CLASSES . 'driver-property-info.php';

		$required = array(); $i = -1;
		if(empty($info['user'])){
			$required[++$i] = new DriverPropertyInfo('user', '');
			$required[$i]->required = true;
			$required[$i]->description = 'Database username';
		}
		if(empty($info['password'])){
			$required[++$i] = new DriverPropertyInfo('password', '');
			$required[$i]->required = true;
			$required[$i]->description = 'Database password';
		}
		return $required;
	}

	function getMajorVersion(){
		return 1;
	}

	function getMinorVersion(){
		return 0;
	}

	function pdbcCompliant(){
		return false;
	}
}
?>