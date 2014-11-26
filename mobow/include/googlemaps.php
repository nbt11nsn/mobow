
<script>
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

    function makeMarker(iconurl, coords, info, map){
        var icon = { 
						url: iconurl, 
						origin: new google.maps.Point(0, 0)
					};
				var marker = new google.maps.Marker({
						position: coords,
						map: map,
						icon: icon,						
					});  
        return marker;
 }


    function makeMarkers(map){
    var places = '<?php echo json_encode($places, JSON_FORCE_OBJECT); ?>';

    var locations = [
      ['<div class="map-popup"><h1>Mowbro-Test</h1><br/><div class="logo"><img src="image/mobow.png" /></div><div class="about">här kan man skriva diverse information som känns vettig.</div></div><div class="clear"></div>', 63.7250, 20.1639, 4],
      ['<div class="map-popup"><h1>'+"hej"+'</h1></div>', 63.8250, 20.2639, 5],
      ['Cronulla Beach', -34.028249, 151.157507, 3],
      ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
      ['Maroubra Beach', -33.950198, 151.259302, 1]
    ];
    
    var infowindow = new google.maps.InfoWindow();

    
     var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({     
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: 'image/icon32x32.png',
        draggable: false        
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));  
   }
}



		(function ( $ ) {
			$.fn.CustomMap = function( options ) {
				var settings = $.extend({
					home: { latitude: 63.8250, longitude: 20.2639 },
					text: '<div class="map-popup"><h1>Mowbro-Test</h1><br/><div class="logo"><img src="image/mobow.png" /></div><div class="about">här kan man skriva diverse information som känns vettig.</div></div><div class="clear"></div>',
					icon_url: 'image/icon32x32.png',					
				}, options );
				
				var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);
					 
				return this.each(function() {	
					var element = $(this);
					
					var options = {
					scrollwheel: false,
						zoom: 14,
						center: coords,
						mapTypeId: google.maps.MapTypeId.HYBRID,
						mapTypeControl: true,
						scaleControl: true,
						zoomControlOptions: {
							style: google.maps.ZoomControlStyle.DEFAULT
						},
						overviewMapControl: true,	
					};	

          var info = new google.maps.InfoWindow({
						content: settings.text
					});
          
					var map = new google.maps.Map(element[0], options);
					
         map.setOptions({styles: getStyles()});
           
           
           

    makeMarkers(map);
    
         
				//	#CCC
				//	#EA005A
				//	#969
					
				});		 
			};
		}( jQuery ));

		jQuery(document).ready(function() {
			jQuery('div.location').CustomMap();
		});
</script>