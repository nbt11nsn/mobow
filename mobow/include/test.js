var infowindow = null;

infowindow = new google.maps.InfoWindow({
content: "holding..."
});

for (var i = 0; i < markers.length; i++) {
var marker = markers[i];
google.maps.event.addListener(marker, 'click', function () {
// where I have added .html to the marker object.
infowindow.setContent(this.html);
infowindow.open(map, this);
});
}





var icon = { 
						url: settings.icon_url, 
						origin: new google.maps.Point(0, 0)
					};

					var marker = new google.maps.Marker({
						position: coords,
						map: map,
						icon: icon,
						draggable: false
					});
					
					var info = new google.maps.InfoWindow({
						content: settings.text
					});

					google.maps.event.addListener(marker, 'click', function() { 
						info.open(map, marker);
					});