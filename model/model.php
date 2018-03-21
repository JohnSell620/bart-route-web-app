<?php
/*
    model.php

    @author Johnny Sellers
    @version 0.1 02/11/17
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'cs75bart');

function get_routes()
{
	$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $routes = $dbh->prepare('SELECT name, number FROM routes WHERE 1');
	$routes->execute();  
	if ($routes)
	{
    $result = array();
    while ($row = $routes->fetch())
		  array_push($result, $row);

    $routes = null;
		$dbh = null;
		return $result;
  }

  $routes = null;
	$dbh = null;
	return null;
}
