<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: <dao:path>Table</dao:path>.php,v 1.0 <dao:date>2006/05/24 15:36:00</dao:date>
* @abstract The <dao:name>Table</dao:name>TO class
*/

require_once DAO_BASE_DIR . 'base-classes/transfer-object.php';

class <dao:name>Table</dao:name>TO extends TransferObject{
	/**
	* Class constructor
	*/
	function &<dao:name>Table</dao:name>TO(){
		parent::TransferObject(array(<dao:field>
			new TransferField('<dao:name></dao:name>', '<dao:field></dao:field>', <dao:default>null</dao:default>, '<dao:type></dao:type>', '<dao:basetype></dao:basetype>', <dao:length></dao:length>, <dao:flags></dao:flags>),</dao:field>
		));
		return $this;
	}<dao:method>

	/**
	* Sets the value of the <dao:name></dao:name> field
	* @param <dao:type></dao:type> $value
	* @param Boolean $check True if the field should be converted to the right format and checked on the "check" method
	* @return void
	*/
	function set<dao:name></dao:name>($value, $check = true){
		$this->set('<dao:name></dao:name>', $value, $check);
	}

	/**
	* Gets the value of the <dao:name></dao:name> field
	* @return <dao:type></dao:type>
	*/
	function get<dao:name></dao:name>(){
		return $this->get('<dao:name></dao:name>');
	}</dao:method><dao:from>

	/**
	* Retrieve the <dao:table></dao:table>TO associated with this object
	* @return <dao:table></dao:table>TO
	*/
	function &load<dao:table></dao:table><dao:field></dao:field>(){
		$o = &$this->loadReference('<dao:table></dao:table>DAO', array(<dao:reference></dao:reference>));
		return $o;
	}</dao:from><dao:to>

	/**
	* Retrieves all the <dao:table></dao:table>TO associated with this object
	* @param $start The start of the list
	* @param $max The max rows that should be returned
	* @param $order The fields that should be ordered
	* @return <dao:table></dao:table>TO[]
	*/
	function &list<dao:table></dao:table><dao:field></dao:field>($max = null, $start = null, $order = null){
		$o = &$this->listReferences('<dao:table></dao:table>DAO', array(<dao:reference></dao:reference>), $max, $start, $order);
		return $o;
	}</dao:to>
}
?>