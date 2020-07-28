<?php


class Parser{

	const DEFAULT_ROUTINE 	= 	'ColonRoutine';		//	Default routine to be called
	const GROUP_PARAMS		=	true;				// 	Groups params in one subarray


	/**
	* 	The parse function separates the URL components between each "/", and applies a function (called 'routine')
	* 	to each component of the URL
	*
	*	@param $url The URL to be parsed
	*	@param $routine The function to be used on each URL component 
	*/
	public function parse($url,$routine){

		//Path to the routine function 
		$routinePath = __DIR__."/Routines/".ucfirst($routine).".php";
		$L_routinePath = __DIR__."/Routines/".$routine.".php";	// In case the file's first letter is capitalized


		if(is_file($L_routinePath)){
			$routinePath = $L_routinePath;
		}

		//Looking for the routine
		if (is_file($routinePath)) {
			$subRoutine = $this->loadRoutine($routinePath,$routine);
		}else{
			echo "Parser Error : Routine ($routine) not found";
			$routinePath = null;
		}


		// Empty result
		$urlComponents = array(
			"module"	=>	"",
			"view"		=>	"",
			"params"	=>	array()
		);


		// If routine file was found
		if(!is_null($routinePath)){

			$url = explode("/", $url);
			$maxCount = sizeof($url);


			// Looking for the function 'particleParse()' in the routine
			if(method_exists($subRoutine, 'particleParse')){

				// Applying the function to each URL component
				foreach ($url as $key => $value) {
					
					$last	= ($key == $maxCount) ? true : false;	// If component is last component
					$empty 	= ($value == '') ? true : false;	// if component is empty (something/(empty)/something)

					// Applying the routine
					$explodeReturn = $subRoutine->particleParse($value,$key+1,$last,$empty);


					// Formatting the returned result for each component
					if(isset($explodeReturn[0]) && isset($explodeReturn[1])){
						
						// If empty, the components name is it's index ($key)
						if($explodeReturn[0] == ''){
							$explodeReturn[0] = $key;
						}

						// The component's name final value should be a string 
						$finalKeyValue = (is_string($explodeReturn[0]))
											? strval($explodeReturn[0])
											: $key; // If it cannot be converted, then it's index is used


						// Finaly, the result is added to the returned array ($urlComponents)
						$urlComponents[$finalKeyValue] = $explodeReturn[1];

					}


				}

			}

			// If the option GROUP_PARAMS is true (it is by default)
			// we proceed to group the components ranging from the 3rd one to the last
			// into a single sub-array labeled "params"
			if(self::GROUP_PARAMS){
				$return = array();

				$return["module"] = $urlComponents["module"];
				$return["view"] = $urlComponents["view"];

				$return["params"] = array_slice($urlComponents, 3);

				return $return;
			}		

		}//

		
		return $urlComponents;	

	}

	/**
	* 	This function loads the routine file
	*	
	*	@param $routinePath The file's path
	*	@param $className The routine's class name
	*/
	private function loadRoutine($routinePath,$className){

		if(is_file($routinePath)){

			ob_start();

			include($routinePath);

			if(class_exists($className))
				return new $className();

			ob_end_flush();

		}

		echo "Parser Error : Error while loading routine ($classPath) <br>";

	}


}