<?php 

/**
*	A (default) routine
*	
*	@example app/articles/title:my-article-title/next:1s5S15D 
*			----> array( 
*					"module" => "app" , 
*					"view" => "articles" , 
*					"params" => array( 
*									"title" => "my-article-title",
*									"next"  => "1s5S15D"
*								 ) )
*/

class ColonRoutine{

	public function __construct(){
		//Nothing done at init
	}


	/**
	*	This is the main function, that parses the URL's components
	*	@param $urlParticle The URL component
	*	@param $count The component's index (starting from 1)
	*	@param $last 'true' if the component is the last one
	*	@param $empty 'true' if the component is empty
	*/
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