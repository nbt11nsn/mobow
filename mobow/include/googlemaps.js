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
						},
            {
							featureType: "infoWindow",
							elementType: "labels",
							stylers: [
              { color: "#969" },
								{ hue: "#969" },
								{ saturation: 50 }
							]
						}
					];	

      return styles;          
}

 function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
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

       
          
					var map = new google.maps.Map(element[0], options);
					
         map.setOptions({styles: getStyles()});
          
                    
		   
      obj_length = obj.length;
      
      
          var latlng = new Array();
        for (var i = 0; i < obj_length; i++) {
           var infoWindow = new google.maps.InfoWindow({                     
					 maxWidth: 300
          });
          var name = obj[i].kontorsnamn;
          var address = obj[i].stad + " " + obj[i].gata;         
          var point = new google.maps.LatLng(
              parseFloat(obj[i].lat),
              parseFloat(obj[i].lng));
          latlng[i] = point;
          var html = "<h1>" + name +"</h1><p>" + address + "</p><p>" + obj[i].oppet + "</p><p>" + obj[i].allminfo + "</p><p>" + obj[i].hemsida + "</p><p>Antal stationer:" + obj[i].stn; + "</p><p>" + obj[i].typ;
          var icon = obj[i].imgurl;
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      
          var latlngbounds = new google.maps.LatLngBounds();
          for (var i = 0; i < latlng.length; i++) {
          latlngbounds.extend(latlng[i]);
            }
        map.fitBounds(latlngbounds);

         
				//	#CCC
				//	#EA005A
				//	#969
					
				});		 
			};
		}( jQuery ));

		jQuery(document).ready(function() {
			jQuery('div.location').CustomMap();
		});