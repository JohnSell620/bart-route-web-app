<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'cs75bart');

$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE;
$dbh = new PDO($dsn, DB_USER, DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_POST['routes'])) {
  echo "No routes no!";
}
else
{
  $stations = json_decode($_POST['routes']);

  $result = array();
  foreach($stations as $key => $station)
  {
    $stmt = $dbh->prepare('SELECT gtfs_longitude FROM stations WHERE abbr=:abbr');
    $stmt->execute([':abbr' => $station]);
  	array_push($result, $stmt->fetch(PDO::FETCH_NUM)[0]);
    $stmt = null;
  }

  if ($result) echo json_encode($result);

}

$dbh = null;

?>
