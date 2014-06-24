<?php
abstract class JSMALL_Config  {

	function get_config($value){
		$jsonFile = file_get_contents('./config/config.json');
		$jsonConfig=json_decode($jsonFile,true);
		return $jsonConfig['config'][$value];
	}

}
?>