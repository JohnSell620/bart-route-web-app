<?php
  require_once('../includes/helper.php');
  render('header', array('title' => 'BART'));
?>


<div class="col-md-8" id="map_canvas" style="height:80%"></div>
<br/><br/>
<div class="col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">SELECT ROUTE</h3>
    </div>
    <br />
    <div class="list-group">
      <?php
        foreach ($routes as $route)
        {
      ?>
          <a href="#" class='list-group-item'
          onclick="addPolyline(<?php echo htmlspecialchars($route[1]); ?>); addMarkers(); showMarkers();">
          <?php print(htmlspecialchars($route[0])); ?>
          </a>

      <?php
        }
      ?>
    </div>
  </div>
</div>

<?php
  render('footer');
?>
