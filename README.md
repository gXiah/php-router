# Simple PHP Router [something](https://img.shields.io/badge/license-MIT-green)
This is a simple PHP router intended to manage URL rewriting and URL parsing routines.

### Quick guide
After having downloaded to project folder, do the following : 

* Load the **Router.php** file (@ project-folder/Router.php)
* Initialize a Router object : `$router = new Router();`
* Make sure to catch the URI `$uri = $_SERVER["REQUEST_URI"]` (Depending on your project, you might need to adapt this step)
* Parse the URI with the following line of code `$router->parse($uri)`
	* **NOTE:** This will automatically use the **Colon Routine** for parsing
	* You **can** change the routine or even create a new one (Instructions bellow)