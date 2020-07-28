<?php

/**
*	Route object (no use except for data storage)
*/

class Route{

	private $data;// Route data

	public function __construct($initData){
		$this->data = $initData;
	}


	public function getData(){
		return $this->data;
	}

}