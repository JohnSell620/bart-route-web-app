<?php
/*
    storeRoutes.php

    @author Johnny Sellers
    @version 0.1 02/11/17
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'cs75bart');

function store_routes()
{
  $url = "http://api.bart.gov/api/route.aspx?cmd=routes&json=y&key=MW9S-E7SL-26DU-VV8V";

  $json = file_get_contents($url);
  $data = json_decode($json, TRUE);
  $route_obj = $data['root']['routes']['route'];

  if ($route_obj)
  {
    $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
  	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare('INSERT INTO routes (routeID, name, abbr, number, color) VALUES (:routeID, :name, :abbr, :number, :color)');

    foreach ($route_obj as $key => $route)
    {
      $route_number = (int) $route['number'];

      $stmt->execute([':routeID' => $route['routeID'], ':name' => $route['name'], ':abbr' => $route['abbr'], ':number' => $route_number, ':color' => $route['color']]);
    }
  }
  else
  {
    echo "Data not retrieved.";
    return null;
  }

  $stmt = null;
	$dbh = null;
	return null;
}
