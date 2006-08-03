<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: print-writer.php,v 1.0 2006/05/09 17:36:00
* @abstract PrintWriter class
*/

class PrintWriter{
	var $_lines = array();

	function println($s){
		$this->_lines[] = $s;
	}
}
?>