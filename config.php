<?php
define('APP_URL', 'http://localhost/awdd/shopping-cart-website-jakewarrenblack');
define("UPLOAD_DIR", "uploads");

define('DB_SERVER', 'localhost');
define('DB_DATABASE', 'login');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

set_include_path(
  get_include_path() . PATH_SEPARATOR . dirname(__FILE__)
);

spl_autoload_register(function ($class_name) {
  require_once 'classes/' . $class_name . '.php';
});

require_once 'vendor/autoload.php';
require_once "lib/global.php";

//We need this for setting the transaction datetime in charge.php
date_default_timezone_set("Europe/Lisbon");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use BookWorms\Http\HttpRequest;

if (!isset($request)) {
  $request = new HttpRequest();
}

//to do : strip out .php endings in url