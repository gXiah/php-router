<?php

require_once("Parser/Parser.php");
require("Parser/Route.php");

class Router{

	private $parser;

	public function __construct(){

		// echo "Router ON";
		$this->parser = new Parser();

	}


	public function parse($url , $parseRoutine=Parser::DEFAULT_ROUTINE){

		return new Route( $this->parser->parse($url,$parseRoutine) );

	}

}