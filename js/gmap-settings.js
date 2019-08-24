// ==========  START GOOGLE MAP ========== //
function initialize() {
"use strict";
var myLatLng = new google.maps.LatLng(10.8907358,106.9042039);
var roadAtlasStyles = [{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}];

var mapOptions = {
    zoom: 12,
    center: myLatLng,
  	disableDefaultUI: false,
	  scrollwheel: false,
    navigationControl: false,
    mapTypeControl: false,
    scaleControl: false,
    draggable: true,
    mapTypeControlOptions: {
    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'roadatlas']
    }
  };

  var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
  var e = map.getCenter();                 
   
  var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: 'images/location-icon.png',
	  title: '',
  });
  
  var contentString = '<div style="max-width: 300px" id="content">'+
      '<div id="bodyContent">'+
	  '<h4>Dịch Vụ Tin Học Tại Nhà.</h4>' +
      '<p style="font-size: 12px">Add: 671, Hương Phước, Phước Tân, Biên Hòa, Đồng Nai, Việt Nam. <br>'+
      'Mobile: +84 129 279 1234. <br>'+
      'Email: ngoton@tinhoctainha.com. <br>'+
      'Website: www.tinhoctainha.com.</p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
  
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
  $(".button-map").click(function () {
        $("#map_canvas").slideToggle(300, function () {
            google.maps.event.trigger(map, "resize"), map.setCenter(e)
        }), $(this).toggleClass("close-map show-map")
  })
  var styledMapOptions = {
    name: 'US Road Atlas'
  };

  var usRoadMapType = new google.maps.StyledMapType(
      roadAtlasStyles, styledMapOptions);

  map.mapTypes.set('roadatlas', usRoadMapType);
  map.setMapTypeId('roadatlas');
}

if($('#map_canvas').length)
google.maps.event.addDomListener(window, "load", initialize);
// ========== END GOOGLE MAP ========== //