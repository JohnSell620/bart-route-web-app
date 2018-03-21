/*
    render.js
    Description: Renders.

    @author Johnny Sellers
    @version 0.1 05/10/2017
*/
var map = "";
var marker = [];
var info = "";
var infowindow = [];
var polylinePath = "";
var routes = [];
var color = "";
var latitudes = [];
var longitudes = [];

function initialize() {
  var mapOptions = {
    center: new google.maps.LatLng(37.775362, -122.417564),
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
}

function getLatitudes() {
  $.ajax({
    type: "POST",
    url: "getLatitudes.php",
    data: {routes: JSON.stringify(routes)},
    async: false,
    success: function(response) {
      latitudes = JSON.parse(response);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert('Status: ' + textStatus);
      alert('Error: ' + errorThrown);
    }
  });
}

function getLongitudes() {
  $.ajax({
    type: "POST",
    url: "getLongitudes.php",
    data: {routes: JSON.stringify(routes)},
    async: false,
    success: function(response) {
      longitudes = JSON.parse(response);
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert('Status: ' + textStatus);
      alert('Error: ' + errorThrown);
    }
  });
}

// Retrieve route info
function getRouteXML(route_no) {
  var deferred = $.Deferred();

  var data = $.get({
    url: "http://api.bart.gov/api/route.aspx?cmd=routeinfo&route="+route_no+"&key=MW9S-E7SL-26DU-VV8V",
    async: false,
    success: function(xml) {

      $(xml).find('station').each(function() {
        routes.push($(this).text());
      });
      color = $(xml).find('color').text();
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      alert('Status: ' + textStatus);
      alert('Error: ' + errorThrown);
    }
  }).done(function() {
    getLatitudes();
    getLongitudes();
  });
}

function addPolyline(route_no) {
  routes.length = 0;
  longitudes.length = 0;
  latitudes.length = 0;
  getRouteXML(route_no);

  var polylineCoordinates = [];
  var i;
  for(var i = 0; i < latitudes.length; i++){
    polylineCoordinates.push(new google.maps.LatLng(latitudes[i], longitudes[i]));
  }

  if(polylinePath != "") removeLine();

  polylinePath = new google.maps.Polyline({
    path: polylineCoordinates,
    strokeColor: color,
    strokeOpacity: 1.0,
    strokeWeight: 2
  });
  addLine();
}

function addLine() {
  polylinePath.setMap(map);
}

function removeLine() {
  polylinePath.setMap(null);
}

// Retrieve station info
function getInfo(st) {
  $.ajax({
    type: "GET",
    url: "getStationInfo.php",
    data: {st: st},
    async: false,
    success: function(response) {
      info = response;
    }
  });
}

function addInfoWindow(marker, st) {
  var infoWindow = new google.maps.InfoWindow({});

  google.maps.event.addListener(marker, 'click', function () {
    getInfo(st);
    infoWindow.setContent(info);
    infoWindow.open(map, marker);
  });
}

// Add station markers to map
function addMarkers() {
  deleteMarkers();
  for(var i = 0; i < latitudes.length; i++) {
    marker[i] = new google.maps.Marker({
    position: new google.maps.LatLng(latitudes[i], longitudes[i]),
    title: "I am a marker!"
    });
    addInfoWindow(marker[i],routes[i]);
  }
}

function setMapMarkers(map) {
  for (var i = 0; i < marker.length; i++) {
    marker[i].setMap(map);
  }
}

function deleteMarkers() {
  setMapMarkers(null);
  marker = [];
}

function showMarkers() {
  setMapMarkers(map);
}
