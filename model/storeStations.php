<?php
/*
    storeStations.php

    @author Johnny Sellers
    @version 0.1 02/11/17
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'cs75bart');

function store_stations()
{
  $url = "http://api.bart.gov/api/stn.aspx?cmd=stns&json=y&key=MW9S-E7SL-26DU-VV8V";

  $json = file_get_contents($url);
  $data = json_decode($json, TRUE);
  $station_obj = $data['root']['stations']['station'];

  if ($station_obj)
  {
    $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
  	$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->prepare('INSERT INTO stations (name, abbr, gtfs_latitude, gtfs_longitude, address, city, county, zipcode) VALUES (:name, :abbr, :gtfs_latitude, :gtfs_longitude, :address, :city, :county, :zipcode)');

    foreach ($station_obj as $key => $station)
    {
      $stmt->execute([':name' => $station['name'], ':abbr' => $station['abbr'], ':gtfs_latitude' => $station['gtfs_latitude'], ':gtfs_longitude' => $station['gtfs_longitude'], ':address' => $station['address'], ':city' => $station['city'], ':county' => $station['county'], ':zipcode' => $station['zipcode']]);
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
