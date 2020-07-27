<?php

class Route{

	private $data;

	public function __construct($initData){
		// echo "Route created";
		$this->data = $initData;
	}


	public function getData(){
		return $this->data;
	}

}