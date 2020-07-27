<?php 

class ColonRoutine{

	public function __construct(){}

	public function particleParse($urlParticle,$count,$last=false,$empty=false){

		switch ($count) {
				case 1:		// Module
					
					return array("module",$urlParticle);
				
				case 2:		// View
					return array("view",$urlParticle);


				default:	//Params
					$components = explode(":",$urlParticle);

					$key = $components[0];
					$components = array_slice($components, 1);

					return array($key,implode(':',$components));

			
		}

		
	}

}