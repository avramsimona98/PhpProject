<?php
require __DIR__ . '/../vendor/autoload.php';
require_once "../app/config.php";
require_once "../app/routes.php";

ini_set("error_log",__DIR__."/../logs/error.log");
ini_set("display_errors",0);
Tracy\Debugger::enable(Tracy\Debugger::PRODUCTION);
if($config->env=="dev"){
    Tracy\Debugger::enable(Tracy\Debugger::DEVELOPMENT);
    ini_set("display_errors",1);
    error_reporting(E_ALL);
}

$url=$_SERVER["REQUEST_URI"];
$queryStr=$_SERVER["QUERY_STRING"];
$router = new Framework\Router();
$router->match($url,$route);
