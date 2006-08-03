<?php
require_once 'classes/template.php';
require_once 'pdbc/pdbc.php';

class Request{
	var $list = array();
	function &Request($types = 'gp'){
		$map = array('h' => 'SERVER', 'g' => 'GET', 'p' => 'POST', 'c' => 'COOKIE', 'f' => 'FILES', 'e' => 'ENV', 's' => 'SESSION');
		for($i = strlen($types = strtolower($types)); $i--;)
			if(isset($map[$x = $types[$i]]) && isset($GLOBALS[$x = '_' . $map[$x]]))
				$this->merge($GLOBALS[$x]);
		return $this;
	}
	function has($name){
		return isset($this->list[$name]);
	}
	function get($name, $default = ''){
		return $this->has($name) ? $this->list[$name] : $default;
	}
	function set($name, $value){
		return $this->list[$name] = $value;
	}
	function del($name){
		$x = $this->get($name, null);
		unset($this->list[$name]);
		return $x;
	}
	function &merge(&$array){
		foreach(array_keys($array) as $n)
			$this->list[$n] = &$array[$n];
		return $this->list;
	}
}


# Load driver
require_once PDBC_DRIVERS . 'mysql.php';

# Emula a função "file_get_contents" caso não exista
if(!function_exists('file_get_contents')){
	function file_get_contents($path, $incpath = 0){
		if(($f = fopen($path, 'rb', $incpath)) !== false){
			$s = fread($f, filesize($path));
			fclose($f);
		}
	}
}

# Emula a função "file_put_contents" caso não exista
if(!function_exists('file_put_contents')){
	function file_put_contents($path, $s, $incpath = 0){
		if(($f = fopen($path, 'wb', $incpath)) !== false){
			fwrite($f, $s);
			fclose($f);
		}
	}
}

function copyDir($dir, $destiny){
	$s = DIRECTORY_SEPARATOR;
	if(!is_dir($dir) || !($dir = dir($dir)))
		return false;
	is_dir($destiny) || mkdir($destiny);
	while(false !== $item = $dir->read())
		if($item != '.' && $item != '..'){
			$from = $dir->path . $s . $item;
			$to = $destiny . $s . $item;
			if(is_dir($from))
				copyDir($from, $to);
			else
				copy($from, $to);
		}
	$dir->close();
}

class DAOGenerator{
	var $_tables = array();
	var $_url = '';
	var $_user = '';
	var $_pass = '';

	function &DAOGenerator($url, $user, $pass){
		$conn = &DriverManager::getConnection($this->_url = $url, $this->_user = $user, $this->_pass = $pass);
		$statement = &$conn->createStatement();
		$tables = &$statement->executeQuery('show tables');
		while($tables->next()){
			$table = &$this->_tables[$tables->getString(1)];
			$table = array(
				'name' => $tables->getString(1),
				'from' => array(),
				'to' => array()
			);
			$sql = &$statement->executeQuery('show create table `' . $table['name'] . '`');
			$sql->next();
			if(preg_match_all('/CONSTRAINT `.*` FOREIGN KEY \(`(.*)`\) REFERENCES `(.*)` \(`(.*)`\)/', $sql->getString(2), $match)){
				foreach(array_keys($match[0]) as $i){
					$table['from'][] = array(
						'table' => $match[2][$i],
						'cols' => explode('`, `', $match[1][$i]),
						'refcols' => explode('`, `',$match[3][$i])
					);
					$ref = &$this->_tables[$match[2][$i]]['to'][];
					$ref = array(
						'table' => $table['name'],
						'cols' => explode('`, `',$match[3][$i]),
						'refcols' => explode('`, `', $match[1][$i])
					);
				}
			}
			$sql->close();

			$resultset = &$statement->executeQuery('select * from `' . $table['name'] . '` limit 1');
			$metadata = &$resultset->getMetaData();
			for($i = 0, $l = $metadata->getColumnCount() + 1; ++$i < $l;){
				$field = &$table['fields'][];
				$field['key'] = isset($metadata->_fields[$i - 1]->flags['primary_key']);
				$field['autoinc'] = isset($metadata->_fields[$i - 1]->flags['auto_increment']);
				$field['name'] = $metadata->getColumnName($i);
				$field['type'] = $metadata->getColumnTypeName($i);
				$field['basetype'] = $this->getTypeName($field['type']);
				$field['signed'] = $metadata->isSigned($i);
				$field['length'] = $metadata->getPrecision($i);
				$field['nullable'] = $metadata->isNullable($i);
			}
			$resultset->close();
		}
		$conn->close();
		return $this;
	}

	function output($verbose = false){
		file_exists($path = 'output/') || mkdir($path);
		file_exists($dao = $path . 'data-access/') || mkdir($dao);
		file_exists($to = $path . 'transfer-object/') || mkdir($to);

		echo "<pre><h3>Copying default files:</h3>\n"
		. 'Copying folder "base-classes" to "' . $path . "base-classes\".\n";
		copyDir('base-classes', $path . 'base-classes');
		echo 'Copying folder "pdbc" to "' . $path . "pdbc\".\n";
		copyDir('pdbc', $path . 'pdbc');
		echo "\n<h3>Generating files:</h3>\n";
		file_put_contents($path . 'dao-factory.php', $this->getFactory());
		echo '% ' . $path . "dao-factory.php\n";
		foreach($this->_tables as $table){
			echo '<hr />';
			$name = strtolower($this->capitalize($table['name'], '-')) . '.php';
			echo '# ' . $dao . $name . "\n";
			file_put_contents($dao . $name, $this->getDataAccessObject($table));
			echo '@ ' . $to . $name . "\n";
			file_put_contents($to . $name, $this->getTransferObject($table));
		}
		echo '</pre>';
	}

	function capitalize($s, $spacer = ''){
		return str_replace(' ', $spacer, ucwords(ereg_replace("[^a-zA-Z ]", " ", strtr($s, "áàãâéêíóôõúùüçÁÀÃÂÉÊÍÓÔÕÚÙÜÇ ", "aaaaeeiooouuucAAAAEEIOOOUUUC "))));
	}

	function clear($s){
		return strtolower($this->capitalize($s));
	}

	function getTypeName($type){
		$types = array('string', 'integer', 'float', 'boolean', 'object', 'array');
		$codes = array(
			'varchar' => 0, 'tinyblob' => 0, 'blob' => 0, 'mediumblob' => 0,
			'longblob' => 0, 'tinytext' => 0, 'text' => 0, 'mediumtext' => 0,
			'longtext' => 0, 'tinyint' => 1, 'smallint' => 1, 'mediumint' => 1,
			'int' => 1, 'bigint' => 1, 'year' => 1, 'double' => 2, 'numeric' => 2,
			'date' => 0, 'datetime' => 0, 'timestamp' => 1, 'time' => 0
		);
		return isset($codes[$type]) ? $types[$codes[$type]] : 'null';
	}

	function getTypeDefault($type, $allowNull){
		$types = array(
			'varchar' => "''", 'tinyblob' => "''", 'blob' => "''", 'mediumblob' => "''",
			'longblob' => "''", 'tinytext' => "''", 'text' => "''", 'mediumtext' => "''",
			'longtext' => "''", 'tinyint' => 0, 'smallint' => 0, 'mediumint' => 0,
			'int' => 0, 'bigint' => 0, 'year' => 0, 'double' => 0, 'numeric' => 0,
			'date' => "'0000-00-00'", 'datetime' => "'0000-00-00 00:00:00'", 'timestamp' => "'0000-00-00 00:00:00'", 'time' => "'00:00:00'"
		);
		return !$allowNull && isset($types[$type]) ? $types[$type] : 'null';
	}

	function getFactory(){
		$x = &new Template(file_get_contents('template/factory.tpl'), '<dao:', '>', '</dao:', '>');
		$root = &$x->root;
		$root->url->_set(addslashes($this->_url));
		$root->user->_set(addslashes($this->_user));
		$root->password->_set(addslashes($this->_pass));
		$root->date->_set(date('Y/m/d H:i:s'));

		$method = &$root->method;
		foreach($this->_tables as $table){
			$name = $this->capitalize($table['name']);
			$method->name[0]->_set($name);
			$method->name[1]->_set($name);
			$method->name[2]->_set($name);
			$method->name[3]->_set($name);
			$method->path->_set(strtolower($this->capitalize($table['name'], '-')));
			$method->_render();
		}
		$method->_set('');
		return $root->_output();
	}

	function getDataAccessObject($table){
		$name = $this->capitalize($table['name']);

		$x = &new Template(file_get_contents('template/data-access-object.tpl'), '<dao:', '>', '</dao:', '>');
		$root = &$x->root;

		$root->date->_set(date('Y/m/d H:i:s'));
		$root->name[0]->_set($name);
		$root->name[1]->_set($name);
		$root->name[2]->_set($name);
		$root->name[3]->_set($name);
		$root->path[0]->_set($path = strtolower($this->capitalize($table['name'], '-')));
		$root->path[1]->_set($path);
		$root->table->_set($table['name']);

		return $root->_output();
	}

	function getTransferObject($table){
		$name = $this->capitalize($table['name']);

		$x = &new Template(file_get_contents('template/transfer-object.tpl'), '<dao:', '>', '</dao:', '>');
		$root = &$x->root;
		$root->date->_set(date('Y/m/d H:i:s'));

		$root->name[0]->_set($name);
		$root->name[1]->_set($name);
		$root->name[2]->_set($name);
		$root->path->_set(strtolower($this->capitalize($table['name'], '-')));

		$field = &$root->field;
		$method = &$root->method;
		foreach($table['fields'] as $f){
			$fieldname = $this->clear($f['name']);
			$value = $f['nullable'] ? 'null' : $this->getTypeDefault($f['type'], $f['nullable']);
			$flags = array();
			$f['key'] && array_push($flags, 'FIELD_PRIMARY');
			$f['nullable'] && array_push($flags, 'FIELD_NULLABLE');
			$f['signed'] && array_push($flags, 'FIELD_SIGNED');
			$f['autoinc'] && array_push($flags, 'FIELD_AUTOINC');

			$field->name->_set($fieldname);
			$field->field->_set($f['name']);
			$field->default->_set($value);
			$field->type->_set($f['type']);
			$field->basetype->_set($f['basetype']);
			$field->length->_set($f['length']);
			$field->flags->_set(count($flags) ? implode(' | ', $flags) : '0');

			$field->_render();

			$fieldname = $this->capitalize($f['name']);

			$method->name[0]->_set($fieldname);
			$method->type[0]->_set(ucfirst($f['basetype']));
			$method->name[1]->_set($fieldname);
			$method->name[2]->_set(strtolower($fieldname));
			$method->name[3]->_set($fieldname);
			$method->type[1]->_set(ucfirst($f['basetype']));
			$method->name[4]->_set($fieldname);
			$method->name[5]->_set(strtolower($fieldname));

			$method->_render();
		}
		$field->_set('');
		$method->_set('');

		$to = &$root->to;
		for($i = count($table['to']); $i--;){
			$ref = &$table['to'][$i];
			$refs = array();
			$cols = array();
			for($needExtraIdentifier = false, $j = count($table['to']); $j--;)
				if($table['to'][$j]['table'] == $ref['table'] && $i != $j){
					$needExtraIdentifier = true;
					$cols[] = $table['to'][$j]['cols'];
					$refs[] = $table['to'][$j]['refcols'];
				}
			if($needExtraIdentifier){
				array_unshift($cols, $ref['cols']);
				array_unshift($refs, $ref['refcols']);
				if(!count($fields = call_user_func_array('array_diff', $cols))
				&& !count($fields = call_user_func_array('array_diff', $refs)))
					$fields = array_merge($ref['cols'], $ref['refcols']);
			}
			$to->table[0]->_set($this->capitalize($ref['table']));
			$to->table[1]->_set($this->capitalize($ref['table']));
			$to->table[2]->_set($this->capitalize($ref['table']));
			$to->table[3]->_set($this->capitalize($ref['table']));
			$to->field->_set($needExtraIdentifier ? 'By' . $this->capitalize(implode(' ', $fields)) : '');
			$reference = array();
			foreach($ref['cols'] as $j=>$name)
				$reference[] = "'" . $this->clear($name) . '\' => \'' . $this->clear($ref['refcols'][$j]) . "'";
			$to->reference->_set(implode(', ', $reference));
			$to->_render();
		}
		$to->_set('');

		$from = &$root->from;
		for($i = count($table['from']); $i--;){
			$ref = &$table['from'][$i];
			$refs = array();
			$cols = array();
			for($needExtraIdentifier = false, $j = count($table['from']); $j--;)
				if($table['from'][$j]['table'] == $ref['table'] && $i != $j){
					$needExtraIdentifier = true;
					$cols[] = $table['from'][$j]['cols'];
					$refs[] = $table['from'][$j]['refcols'];
				}
			if($needExtraIdentifier){
				array_unshift($cols, $ref['cols']);
				array_unshift($refs, $ref['refcols']);
				if(!count($fields = call_user_func_array('array_diff', $cols))
				&& !count($fields = call_user_func_array('array_diff', $refs)))
					$fields = array_merge($ref['cols'], $ref['refcols']);
			}
			$from->table[0]->_set($this->capitalize($ref['table']));
			$from->table[1]->_set($this->capitalize($ref['table']));
			$from->table[2]->_set($this->capitalize($ref['table']));
			$from->table[3]->_set($this->capitalize($ref['table']));
			$from->field->_set($needExtraIdentifier ? 'By' . $this->capitalize(implode(' ', $fields)) : '');
			$reference = array();
			foreach($ref['cols'] as $j=>$name)
				$reference[] = "'" . $this->clear($name) . '\' => \'' . $this->clear($ref['refcols'][$j]) . "'";
			$from->reference->_set(implode(', ', $reference));
			$from->_render();
		}
		$from->_set('');
		return $root->_output();
	}
}
?>