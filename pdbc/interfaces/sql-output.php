<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-output.php,v 1.0 2006/05/09 18:58:07
* @abstract The output stream for writing the attributes of a user-defined type back to the database
*/

class SQLOutput{
	/**
	* Writes an SQL ARRAY value to the stream
	* @return Vector
	*/
	function writeArray(){
		die('Not implemented');
	}

 	/**
	* Writes the next attribute to the stream as a stream of ASCII characters
	* @return InputStream
	*/
	function writeAsciiStream(){
		die('Not implemented');
	}

 	/**
	* Writes the next attribute to the stream as a java.math.BigDecimal object
	* @return BigDecimal
	*/
	function writeBigDecimal(){
		die('Not implemented');
	}

 	/**
	* Writes the next attribute to the stream as a stream of uninterpreted bytes
	* @return InputStream
	*/
	function writeBinaryStream(){
		die('Not implemented');
	}

 	/**
	* Writes an SQL BLOB value to the stream and returns it as a Blob object
	* @return Blob
	*/
	function writeBlob(){
		die('Not implemented');
	}

 	/**
	* Writes the next attribute to the stream as a boolean
	* @return Boolean
	*/
	function writeBoolean(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a byte
	* @return Integer
	*/
	function writeByte(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as an array of bytes
	* @return Integer[]
	*/
	function writeBytes(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a stream of Unicode characters
	* @return writeer
	*/
	function writeCharacterStream(){
		die('Not implemented');
	}

	/**
	* Writes an SQL CLOB value to the stream and returns it as a Clob object
	* @return Clob
	*/
	function writeClob(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a java.sql.Date object
	* @return Date
	*/
	function writeDate(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a double
	* @return Float
	*/
	function writeDouble(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a float
	* @return Float
	*/
	function writeFloat(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as an int
	* @return Integer
	*/
	function writeInt(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a long
	* @return Integer
	*/
	function writeLong(){
		die('Not implemented');
	}

	/**
	* Writes an SQL NCLOB value to the stream and returns it as a NClob object
	* @return NClob
	*/
	function writeNClob(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a String
	* @return String
	*/
	function writeNString(){
		die('Not implemented');
	}

	/**
	* Writes the datum at the head of the stream and returns it as an Object
	* @return Object
	*/
	function writeObject(){
		die('Not implemented');
	}

	/**
	* Writes an SQL REF value to the stream and returns it as a Ref object
	* @return Ref
	*/
	function writeRef(){
		die('Not implemented');
	}

	/**
	* Writes an SQL ROWID value to the stream and returns it as a RowId object
	* @return RowId
	*/
	function writeRowId(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a short
	* @return Integer
	*/
	function Writeshort(){
		die('Not implemented');
	}

	/**
	* Writes an SQL XML value to the stream and returns it as a SQLXML object
	* @return SQLXML
	*/
	function WritesQLXML(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a String
	* @return String
	*/
	function Writestring(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a java.sql.Time object
	* @return Time
	*/
	function writeTime(){
		die('Not implemented');
	}

	/**
	* Writes the next attribute to the stream as a java.sql.Timestamp object
	* @return Timestamp
	*/
	function writeTimestamp(){
		die('Not implemented');
	}

	/**
	* Writes an SQL DATALINK value to the stream and returns it as a java.net.URL object
	* @return URL
	*/
	function writeURL(){
		die('Not implemented');
	}
}
?>