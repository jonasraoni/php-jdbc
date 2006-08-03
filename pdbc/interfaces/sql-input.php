<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: sql-input.php,v 1.0 2006/05/09 18:58:07
* @abstract An input stream that contains a stream of values representing an instance of an SQL structured type or an SQL distinct type
*/

class SQLInput{
	/**
	* Reads an SQL ARRAY value from the stream and returns it as an Array object
	* @return Vector
	*/
	function readArray(){
		die('Not implemented');
	}

 	/**
	* Reads the next attribute in the stream and returns it as a stream of ASCII characters
	* @return InputStream
	*/
	function readAsciiStream(){
		die('Not implemented');
	}

 	/**
	* Reads the next attribute in the stream and returns it as a java.math.BigDecimal object
	* @return BigDecimal
	*/
	function readBigDecimal(){
		die('Not implemented');
	}

 	/**
	* Reads the next attribute in the stream and returns it as a stream of uninterpreted bytes
	* @return InputStream
	*/
	function readBinaryStream(){
		die('Not implemented');
	}

 	/**
	* Reads an SQL BLOB value from the stream and returns it as a Blob object
	* @return Blob
	*/
	function readBlob(){
		die('Not implemented');
	}

 	/**
	* Reads the next attribute in the stream and returns it as a boolean
	* @return Boolean
	*/
	function readBoolean(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a byte
	* @return Integer
	*/
	function readByte(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as an array of bytes
	* @return Integer[]
	*/
	function readBytes(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a stream of Unicode characters
	* @return Reader
	*/
	function readCharacterStream(){
		die('Not implemented');
	}

	/**
	* Reads an SQL CLOB value from the stream and returns it as a Clob object
	* @return Clob
	*/
	function readClob(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a java.sql.Date object
	* @return Date
	*/
	function readDate(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a double
	* @return Float
	*/
	function readDouble(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a float
	* @return Float
	*/
	function readFloat(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as an int
	* @return Integer
	*/
	function readInt(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a long
	* @return Integer
	*/
	function readLong(){
		die('Not implemented');
	}

	/**
	* Reads an SQL NCLOB value from the stream and returns it as a NClob object
	* @return NClob
	*/
	function readNClob(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a String
	* @return String
	*/
	function readNString(){
		die('Not implemented');
	}

	/**
	* Reads the datum at the head of the stream and returns it as an Object
	* @return Object
	*/
	function readObject(){
		die('Not implemented');
	}

	/**
	* Reads an SQL REF value from the stream and returns it as a Ref object
	* @return Ref
	*/
	function readRef(){
		die('Not implemented');
	}

	/**
	* Reads an SQL ROWID value from the stream and returns it as a RowId object
	* @return RowId
	*/
	function readRowId(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a short
	* @return Integer
	*/
	function readShort(){
		die('Not implemented');
	}

	/**
	* Reads an SQL XML value from the stream and returns it as a SQLXML object
	* @return SQLXML
	*/
	function readSQLXML(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a String
	* @return String
	*/
	function readString(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a java.sql.Time object
	* @return Time
	*/
	function readTime(){
		die('Not implemented');
	}

	/**
	* Reads the next attribute in the stream and returns it as a java.sql.Timestamp object
	* @return Timestamp
	*/
	function readTimestamp(){
		die('Not implemented');
	}

	/**
	* Reads an SQL DATALINK value from the stream and returns it as a java.net.URL object
	* @return URL
	*/
	function readURL(){
		die('Not implemented');
	}

	/**
	* Retrieves whether the last value read was SQL NULL
	* @return Boolean
	*/
	function wasNull(){
		die('Not implemented');
	}
}
?>