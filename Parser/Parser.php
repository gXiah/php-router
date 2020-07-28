<?php


class Parser{

	const DEFAULT_ROUTINE 	= 	'ColonRoutine';		//	Default routine to be called
	const GROUP_PARAMS		=	true;				// 	Groups params in one subarray

	public function parse($url,$routine){

		$routinePath = __DIR__."/Routines/".ucfirst($routine).".php";
		$L_routinePath = __DIR__."/Routines/".$routine.".php";

		if(is_file($L_routinePath)){
			$routinePath = $L_routinePath;
		}

		if (is_file($routinePath)) {
			$subRoutine = $this->loadRoutine($routinePath,$routine);
		}else{
			echo "Parser Error : Routine ($routine) not found";
			$routinePath = null;
		}

		if(!is_null($routinePath)){

			$url = explode("/", $url);
			$maxCount = sizeof($url);

			$urlComponents = array(
					"module"	=>	"",
					"view"		=>	"",
					"params"	=>	array()
				);

			if(method_exists($subRoutine, 'particleParse')){

				foreach ($url as $key => $value) {
					
					$last	= ($key == $maxCount) ? true : false;
					$empty 	= ($value == '') ? true : false;

					$explodeReturn = $subRoutine->particleParse($value,$key+1,$last,$empty);

					if(isset($explodeReturn[0]) && isset($explodeReturn[1])){
						if($explodeReturn[0] == ''){
							$explodeReturn[0] = $key;
						}
						$finalKeyValue = (is_string($explodeReturn[0]))
											? strval($explodeReturn[0])
											: $key;
						$urlComponents[$finalKeyValue] = $explodeReturn[1];

					}


				}

			}

			if(self::GROUP_PARAMS){
				$return = array();

				$return["module"] = $urlComponents["module"];
				$return["view"] = $urlComponents["view"];

				$return["params"] = array_slice($urlComponents, 3);

				return $return;
			}

			return $urlComponents;			

		}//

		

	}

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