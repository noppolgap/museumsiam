function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: {lat: -33.9, lng: 151.2}
  });

  setMarkers(map);
}

var museums = [
  ['Bondi museum', -33.890542, 151.274856, 4],
  ['Coogee museum', -33.923036, 151.259052, 5],
  ['Cronulla museum', -34.028249, 151.157507, 3],
  ['Manly museum', -33.80010128657071, 151.28747820854187, 2],
  ['Maroubra museum', -33.950198, 151.259302, 1]
];

function setMarkers(map) {
	
  var image = {
    url: 'images/gis_pin.png',
    size: new google.maps.Size(37, 39),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 39)
  };

  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };
  for (var i = 0; i < museums.length; i++) {
    var museum = museums[i];
    var marker = new google.maps.Marker({
      position: {lat: museum[1], lng: museum[2]},
      map: map,
      icon: image,
      shape: shape,
      title: museum[0],
      zIndex: museum[3]
    });
  }
}