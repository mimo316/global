<?php
	function utf8ize($d){ 
		if (is_array($d) || is_object($d)){
			foreach ($d as &$v) $v = utf8ize($v);
			return $d;
		}else{
			return utf8_encode($d);
		}
	}
?>
