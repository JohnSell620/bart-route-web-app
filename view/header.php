<!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($title) ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

  <style type="text/css">
    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0 }
    #map_canvas {
      display: inline-block;
      width: 70%;
      height: 90%;
    }
    #route_container {
      display: inline-block;
      width: 30%;
      margin-left: .5em;
      vertical-align: top;
    }
    /*#select_route {width:20%;height:200px;}*/
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  <script async defer src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAeEUgL2Dz-lovWiAuPE8PYIuq777ZT6Dg" type="text/javascript"></script>
  <script type="text/javascript" src="render.js" ></script>

  <!-- favicon  -->
  <link rel="apple-touch-icon" sizes="57x57" href="/favic/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/favic/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/favic/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/favic/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/favic/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/favic/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/favic/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/favic/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/favic/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="/favic/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favic/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="/favic/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favic/favicon-16x16.png">
  <link rel="manifest" href="/favic/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/favic/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

</head>

<body onload="initialize();">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Display BART Route and Station Info</a>
      </div>
    </div><!-- /.container-fluid -->
</nav>
