<?php

namespace Env;

class Logger{

	const INFO 		= 1;
	const WARNING 	= 2;
	const DANGER	= 3;
	const SUCCESS	= 4;

	public static function add($msg,$typeCode=self::INFO){
		$_POST["logs"][] = "[ type #$typeCode ] - $msg";
	}

}