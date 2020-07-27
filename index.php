<pre>
<?php

require_once("Router.php");

$router = new Router();
print_r($router->parse("module/view/param1:value1/param2:value2"));