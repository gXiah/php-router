# Simple PHP Router <br> <img src="https://img.shields.io/badge/license-MIT-green" alt="Licence - MIT"> <img src="https://img.shields.io/badge/Target%20Level-Beginner-green" alt="Target Level - Beginner">

This is a simple PHP router intended to manage URL rewriting and URL parsing routines.
- You will find in this document the following : 
	- A quick start guide
	- An in-depth description
	- A guide on how to create a new routine
	- A list of planned modifications

### Quick start guide
After having downloaded to project folder, do the following : 

* Load the **Router.php** file (@ project-folder/Router.php)
* Initialize a Router object : `$router = new Router();`
* Make sure to catch the request URI `$uri = $_SERVER["REQUEST_URI"]` (Depending on your project, you might need to adapt this step)
* Parse the request URI with the following line of code `$router->parse($uri)`
	* **NOTE:** This will automatically use the **Colon Routine** for parsing
	* You **can** change the routine or even create a new one (Instructions bellow)

### In-depth description
The router, after having been initialized, can be fed a URL formatted like so : `firstComponent/Second/.../LastComponent` <br>
The parser loops through the URL by singeling out all the components, and executing a *Routine* on every one of them. As of the *27th of July 2020*, this projects has only got one (default) routine, the *Colon Routine* that interprets URLs formatted like so : `component1/component2/component3:value1/.../lastCmp:lastValue` and returns the following array : 
- Module 	: 	component1
- View		: 	component2
- Params	:
	-	component3 	: 	value1
	-	...
	- lastCmp		:	lastValue
<br>
The router puts this data into a *Route* object, returned by the *Router::parse()* function.
<br>
### Creating a new routine