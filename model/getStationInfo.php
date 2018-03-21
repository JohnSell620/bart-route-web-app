<?php

header("Content-type: text/html");


if(!isset($_GET['st'])) {
  echo "No station info. \n";
}
else
{
  $st = $_GET['st'];
  $url = "http://api.bart.gov/api/etd.aspx?cmd=etd&orig={$st}&key=MW9S-E7SL-26DU-VV8V";

  if (($response_xml_data = file_get_contents($url))===false)
  {
      echo "Error fetching XML\n";
  }
  else
  {
    libxml_use_internal_errors(true);
    $data = simplexml_load_string($response_xml_data);
    if (!$data)
    {
       echo "Error loading XML\n";
       foreach(libxml_get_errors() as $error) {
           echo "\t", $error->message;
       }
    }
    else
    {
      print("<b>BART departures-".$data->station->name."</b></br>");
      print("<b>".$data->date."</b>&nbsp;&nbsp;");
      print("<b>".$data->time."</b></br></br>");
      $station = $data->station;

      foreach($station->etd  as $key => $station_etd)
      {
      	print('<b>'.$station_etd->abbreviation.'</b></br>');
      	foreach ($station_etd->estimate as $estimated_time)
        {
      		print('platform'.$estimated_time->platform.'&nbsp;&nbsp;&nbsp;');
      		print('<span>'.$estimated_time->minutes.'&nbsp;min</span>&nbsp;');
      		print('<span style="background-color:'.$estimated_time->hexcolor.';">('.$estimated_time->length.'&nbsp;car)</span></br>');
      	}
      	print('</br>');
      }
    }
  }
}


?>
