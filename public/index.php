<?php
require __DIR__ . '/../vendor/autoload.php';
require_once "../app/config.php";
require_once "../app/routes.php";

//ini_set("error_log",__DIR__."/../logs/error.log");
//ini_set("display_errors",0);
//if($config["env"]=="dev"){
//    ini_set("display_errors",1);
//    error_reporting(E_ALL);
//}
////echo $_SERVER["QUERY_STRING"];
////echo $_SERVER["REQUEST_URI"];
//if(($routes[$_SERVER["Request_URI"]])){
//    $controller = new Posts(controller());
//    $controller = $routes[$SERVER[...]]["action"]();
//}
//else {
//echo "404";
//}
//require_once "../src/Router.php";
$url=$_SERVER["REQUEST_URI"];
$queryStr=$_SERVER["QUERY_STRING"];
$router = new Framework\Router();
$router->match($url,$route);
