<?php
  require_once('../model/model.php');
  require_once('../includes/helper.php');

  $routes = get_routes();
  render('home',array('routes' => $routes));
?>
