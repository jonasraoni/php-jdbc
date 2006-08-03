<?php
/*
* @author Jonas Raoni
* @url https://github.com/jonasraoni/php-jdbc
* @version $Id: <dao:path></dao:path>.php,v 1.0 <dao:date>2006/05/24 15:36:00</dao:date>
* @abstract The <dao:name>Table</dao:name>DAO class
*/

require_once DAO_BASE_DIR . 'base-classes/data-access-object.php';

class <dao:name>Table</dao:name>DAO extends DataAccessObject{
	function <dao:name>Table</dao:name>DAO(){
		require_once DAO_BASE_DIR . 'transfer-object/<dao:path>table</dao:path>.php';
		parent::DataAccessObject('<dao:table>table</dao:table>', '<dao:name>Table</dao:name>TO');
	}
}
?>