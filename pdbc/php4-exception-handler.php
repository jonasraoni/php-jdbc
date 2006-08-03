<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: php4-exception-handler.php,v 1.0 2006/05/20 20:36:00
* @abstract Class simulating a poor exception handling
*/

/* Class property emulation */
$GLOBALS['PDBCExceptionException'] = null;

class PDBCException{
	/**
	* Throws an exception
	* @param Exception $exception The exception object
	*/
	function throwIt(&$exception){
		$GLOBALS['PDBCExceptionException'] = &$exception;
		if(ON_EXCEPTION_DIE)
			PDBCException::raise($exception);
	}

	/**
	* Catches an exception given it's type
	* @param String $args Variable arguments containing exception class names
	* @return Exception or null if none matches the criteria
	*/
	function &catchIt($args = null){
		global $PDBCExceptionException;
		foreach(func_get_args() as $arg)
			if(is_a($PDBCExceptionException, $arg)){
				$o = &$PDBCExceptionException;
				$GLOBALS['PDBCExceptionException'] = &$null;
				return $o;
			}
		return $null;
	}

	/**
	* Check if there's an exception not catched, if found calls the "raise" method
	* @param Exception $exception
	*/
	function check(){
		global $PDBCExceptionException;
		if($PDBCExceptionException)
			PDBCException::raise($PDBCExceptionException);
	}

	/**
	* Stops the processing and raises the exception to the main thread
	* @param Exception $exception
	*/
	function raise(&$exception){
		if($msg = $exception->getMessage())
			$msg = "with message \"$msg\"";
		echo 'Uncaught exception "' . get_class($exception) . '" ' . $msg . ' at [' . $exception->getFile() . ':' . $exception->getLine() . "]\n";
		exit($exception->getTraceAsString());
	}
}

/* PHP 5 Exception class emulation */
if(!class_exists('Exception')){
	class Exception{
		var $_message = '';
		var $_code = 0;
		var $_line = 0;
		var $_file = '';
		var $_trace = null;

		function Exception($message = 'Unknown exception', $code = 0){
			$this->_message = $message;
			$this->_code = $code;
			$this->_trace = debug_backtrace();
			$x = array_shift($this->_trace);
			$this->_file = $x['file'];
			$this->_line = $x['line'];
		}

		function __construct($message = 'Unknown exception', $code = 0){
			$this->Exception($message, $code);
		}

		function getMessage(){
			return $this->_message;
		}
		function getCode(){
			return $this->_code;
		}
		function getFile(){
			return $this->_file;
		}
		function getLine(){
			return $this->_line;
		}
		function getTrace(){
			return $this->_trace;
		}
		function getTraceAsString(){
			$s = '';
			foreach($this->_trace as $i=>$item){
				foreach($item['args'] as $j=>$arg)
					$item['args'][$j] = print_r($arg, true);
				$s .= "#$i " . (isset($item['class']) ? $item['class'] . $item['type'] : '') . $item['function']
				. '(' . implode(', ', $item['args']) . ") at [$item[file]:$item[line]]\n";
			}
			return $s;
		}
		function printStackTace(){
			echo $this->getTraceAsString();
		}
		function toString(){
			return $this->getMessage();
		}
		function __toString(){
			return $this->toString();
		}
	}
}
?>