function getStyles(){
		var styles = [{
							featureType: "all",
							stylers: [
							  { saturation: -20 }
							]
						},{
							featureType: "road",
							elementType: "geometry",
							stylers: [
							  { hue: "#EA005A" },
							  { saturation: 50 }
							]
						}, {
							featureType: "road",
							elementType: "labels",
							stylers: [
								{ hue: "#969" },
								{ saturation: 50 }
							]
						}
					];	

      return styles;          
}

var customIcons = {
      restaurant: {
        icon: 'image/restaurang.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
      }
    };


 function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
 


		(function ( $ ) {
			$.fn.CustomMap = function( options ) {			
				
				var coords = new google.maps.LatLng(63.8250, 20.2639);
					 
				return this.each(function() {	
					var element = $(this);
					
					var options = {
					scrollwheel: false,
						zoom: 6,
						center: coords,
						mapTypeId: google.maps.MapTypeId.HYBRID,
						mapTypeControl: true,
						scaleControl: true,
						zoomControlOptions: {
							style: google.maps.ZoomControlStyle.DEFAULT
						},
						overviewMapControl: true,	
					};	

          var infoWindow = new google.maps.InfoWindow({						
					});
          
					var map = new google.maps.Map(element[0], options);
					
         map.setOptions({styles: getStyles()});
          
                    
		   downloadUrl("include/connection.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = "restaurant";
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
           

         
				//	#CCC
				//	#EA005A
				//	#969
					
				});		 
			};
		}( jQuery ));

		jQuery(document).ready(function() {
			jQuery('div.location').CustomMap();
		});