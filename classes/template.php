<?php
class Template{
	var $oo, $oc, $co, $cc, $tags = array();

	function Template($s, $oo = '<js:', $oc = '>', $co = '</js:', $cc = '>'){
		$o = &$this; $o->oo = $oo; $o->oc = $oc; $o->co = $co; $o->cc = $cc;
		if($o->oo == $o->co || $o->oo == $o->oc || $o->oo == $o->cc || $o->co == $o->oc || $o->co == $o->cc)
			trigger_error(__CLASS__ . '.' . __FUNCTION__ . ': Tag definition not allowed', E_USER_ERROR);
		$o->root = &new Node($this, '_root', $s, $x);
		$o->root->_parent = null;
		$o->parse($s);
	}

	function parse($s){
		$_ = &$this; $y = &$_->tags; $p = 0;
		$l = array(array(-1, strlen($s), &$_->root));
		$i = $_->oo; $e = $_->co; $z = $_->oc; $d = $_->cc;
		$h = strlen($z);
		while(($p = indexOf($s, $i, $p)) > -1){
			if($p == indexOf($s, $e, $p) && ++$p) continue;
			$a = ($a = $p + strlen($i)) + strlen($t = slice($s, $a, $j = indexOf($s, $z, $p))) + $h;
			$f = indexOf($s, $g = $e . $t . $d, $p);
			while(($j = indexOf($s, $i . $t . $d, $j + 1)) + 1 && $j < $f)
				$f = indexOf($s, $g, $f + 1);
			if(substr($t, 0, 1) == '_')
				trigger_error(__CLASS__ . '.' . __FUNCTION__ . ": Tag name not allowed [$t]", E_USER_ERROR);
			if($f < 0)
				trigger_error(__CLASS__ . '.' . __FUNCTION__ . ": End of tag \"$i$t$z\" expected", E_USER_ERROR);
			for($v = slice($s, $a, $f), $j = count($l); $j--;){
				$c = &$l[$j];
				if($p > $c[0] && $f < $c[1]){
					$v = &new Node($_, $t, $v, $c[2]);
					if(isset($c[2]->$t))
						if(is_array($c[2]->$t))
							$c[2]->{$t}[] = &$v;
						else{
							$a = &$c[2]->$t;
							unset($c[2]->$t);
							$c[2]->$t = array(&$a, &$v);
							unset($a);
						}
					else
						$c[2]->$t = &$v;
					if(is_array($c[2]->$t))
						array_push($l, array($p++, $f, &$c[2]));
					else
						array_push($l, array($p++, $f, &$v));
					if(!($a = &$c[2]->_parent))
						$x = &$c[2];
					else
						$x = &$a->{$c[2]->_name};
					$x->_children[] = &$v;
					$y[] = &$v; unset($v); unset($a);
					break;
				}
			}





		}
	}
}

class Node{
	var $_default, $_value, $_parent, $_children, $_name, $_template;

	function Node(&$t, $n, $v, &$p){
		$o = &$this;
		$o->_template = &$t;
		$o->_default = $v;
		$o->_value = array($v);
		$o->_parent = &$p;
		$o->_children = array();
		$o->_name = $n;
	}

	function _render($_o = 0){
		$o = &$this->_children;
		$s = end($this->_value);
		$p = array(); $i = -1;
		$x = &$this->_template;
		$t = $x->oo; $c = $x->co; $tc = $x->oc; $cc = $x->cc;
		while(isset($o[++$i]) && ($y = &$o[$i]) && (($v = slice($s, 0, $j = indexOf($s, $to = $t . ($a = $y->_name) . $tc))) || 1) && ($f = indexOf($s, $a = $c . $a . $cc, $j))){
			while(($j = indexOf($s, $to, $j + 1)) + 1 && $j < $f)
				$f = indexOf($s, $a, $f + 1);
			$f + 1 && ($s = $v . implode('', $y->_value) . slice($s, strlen($a) + $f));
			if(isset($y->_children[0])){
				$p[] = $i;
				$p[] = &$o;
				$o = &$y->_children;
				$i = -1;
			}
			elseif(!isset($o[$i + 1]))
				while(count($p)){
					$o = &$p[count($p) - 1];
					array_pop($p);
					if(isset($o[($i = array_pop($p)) + 1]))
						break;
				}
		}
		if($_o) return $s;
		else{
			$v[$i = count($v = &$this->_value)] = $v[--$i];
			return $v[$i] = $s;
		}
	}

	function _set($s){
		return $this->_value[count($this->_value) - 1] = $s;
	}
	function _get(){
			$_ = &$this->_template;
			return preg_replace('/' . preg_quote($_->oo, '/') . '.*?' . preg_quote($_->oc, '/') . '|'
			. preg_quote($_->co, '/') . '.*?' . preg_quote($_->cc, '/') . '/', '', implode('', $this->_value));
	}
	function _reset($c = 0){
			$x = array();
			$o = &$this->_children;
			if($c) do for($c = count($o); $c--; $o[$c]->_value = array($o[$c]->_default), count($o[$c]->_children) && $x[] = &$o[$c]->_children);
			while(count($x) && ($o = &$x[0]) && array_pop($x));
			return $this->_value = array($this->_default);
	}
	function _output(){
		return $this->_render(1);
	}
}

function indexOf($s, $s2, $offset = 0){
	if($offset < 0) $offset = 0;
	return ($i = strpos($s, $s2, $offset)) === false ? -1 : $i;
}

function slice($s, $i, $f = -1){
	$f == -1 && ($f = strlen($s));
	return substr($s, $i, $f - $i);
}
?>