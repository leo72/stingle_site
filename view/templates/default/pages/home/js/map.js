$('document').ready(function(){
	var mapOptions = {
	          center: new google.maps.LatLng(0, 0),
	          zoom: 3,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        };
	var map = new google.maps.Map(document.getElementById("map"),  mapOptions);
});