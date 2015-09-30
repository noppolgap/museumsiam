var defaultLat = 13.744444;
var defaultLot = 100.494148;
var MyLatitude;
var MyLongitude;
var infoWindow;
var map;
var museums;
var markerArray = [];
var museumsDetail = [];
var DirectionID = 0;
var bounds;
var directionsDisplay;
var directionsService;
var sharedLocation = true;

function initMap() {
	directionsService = new google.maps.DirectionsService;
	directionsDisplay = new google.maps.DirectionsRenderer;
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 10,
		center: {
			lat: defaultLat,
			lng: defaultLot
		}
	});

	var rendererOptions = {
		map: map,
		suppressMarkers: true,
		draggable: true
	}

	bounds = new google.maps.LatLngBounds();
	directionsDisplay.setMap(map);
	stepDisplay = new google.maps.InfoWindow();

	setMarkers(map);
}

function setMarkers(map, markers) {

	var image = {
		url: 'images/gis_pin.svg',
		size: new google.maps.Size(30, 37),
		origin: new google.maps.Point(0, 0),
		anchor: new google.maps.Point(0, 37)
	};

	infoWindow = new google.maps.InfoWindow(), marker, i;

	for (var i = 0; i < museums.length; i++) {
		var museum = museums[i];
		var myLatLng = new google.maps.LatLng(museum[1], museum[2]);
		bounds.extend(myLatLng);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon: image,
			title: museum[0],
			zIndex: museum[4]
		});

		var Mystr = '<iframe src="gis_frame.php?p=' + museum[3] + '&lat=' + museum[1] + '&lng=' + museum[2] + '" id="MapIframe" name="myiFrame" scrolling="no" frameborder="0"></iframe>';

		museumsDetail[i] = Mystr;

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {

				infoWindow.setContent('<div> ' + museumsDetail[i] + '</div>');
				infoWindow.open(map, marker);
			}
		})(marker, i));

		map.setCenter(bounds.getCenter());
		map.fitBounds(bounds);
		markerArray.push(marker);
	}


	return markerArray;
}

function getLocation() {
	if (sharedLocation) {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition, showError);
		} else {
			showError();
		}
	} else {
		calcRoute(true);
		console.log(11);
	}

}

function showPosition(position) {
	MyLatitude = position.coords.latitude;
	MyLongitude = position.coords.longitude;
	sharedLocation = false;
	calcRoute(true);
}

function showError(error) {
	MyLatitude = defaultLat;
	MyLongitude = defaultLot;
}

function calcRoute(currentLocation) {


	if (currentLocation == true) {
		if (MyLatitude == undefined) {
			MyLatitude = defaultLat;
		}
		if (MyLongitude == undefined) {
			MyLongitude = defaultLot;
		}

		var start = MyLatitude + ' , ' + MyLongitude;
	} else {
		var start = currentLocation;
	}

	var start = MyLatitude + ' , ' + MyLongitude;


	var end = endLatitude + ' , ' + endLongitude;
	var request = {
		origin: start,
		destination: end,
		travelMode: google.maps.TravelMode.DRIVING
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
			showSteps(response);
		}
	});

	console.log(start);
	console.log(end);

}

function getDirections(id, currentLocation, maplat, maplong) {
	DirectionID = id;
	endLatitude = maplat;
	endLongitude = maplong;

	if (currentLocation == '') {
		getLocation();
	} else {
		calcRoute(currentLocation);
	}

	clearMarkers(map, markerArray);
}

function clearMarkers(map, markers) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(null);
	}
}

function showSteps(directionResult) {

	var image1 = {
		url: 'images/gis_pin.svg',
		size: new google.maps.Size(34, 40)
	};

	var image2 = {
		url: 'images/gis_pin.svg',
		size: new google.maps.Size(34, 40)
	};

	var myRoute = directionResult.routes[0].legs[0];
	var step = myRoute.steps.length;

	var marker = new google.maps.Marker({
		position: myRoute.steps[0].start_point,
		map: map,
		icon: image1,
		title: 'Current Location',
		draggable: true,
		zIndex: 5
	});
	markerArray.push(marker);
	/*
	google.maps.event.addListener(marker, 'dragend', function(event) {
		var MyLat = event.latLng.lat();
		var MyLng = event.latLng.lng();
		var getPosition = MyLat + ' , ' + MyLng;
		console.log(getPosition);
		getDirections(DirectionID, getPosition, endLatitude, endLongitude);
	});

	var infowindow = new google.maps.InfoWindow({
		content: '<iframe src="gis_frame.php?p=' + DirectionID + '&lat=' + endLatitude + '&lng=' + endLongitude + '" id="MapIframe" name="myiFrame" scrolling="no" frameborder="0"></iframe>'
	});
	*/
	var marker = new google.maps.Marker({
		position: myRoute.steps[step - 1].end_point,
		map: map,
		icon: image2,
		zIndex: 5
	});
	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map, marker);
	});


	markerArray.push(marker);

}