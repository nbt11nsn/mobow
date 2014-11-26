
		(function ( $ ) {
			$.fn.CustomMap = function( options ) {
				var settings = $.extend({
					home: { latitude: 63.8250, longitude: 20.2639 },
					text: '<div class="map-popup"><h1>Mowbro-Test</h1><br/><div class="logo"><img src="image/mobow.png" /></div><div class="about">här kan man skriva diverse information som känns vettig.</div></div><div class="clear"></div>',
					icon_url: 'image/icon.png',					
				}, options );
				
				var coords = new google.maps.LatLng(settings.home.latitude, settings.home.longitude);
					 
				return this.each(function() {	
					var element = $(this);
					
					var options = {
					scrollwheel: false,
						zoom: 5,
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

				//	#CCC
				//	#EA005A
				//	#969
					
					map.setOptions({styles: styles});
				});
		 
			};
		}( jQuery ));

		jQuery(document).ready(function() {
			jQuery('div.location').CustomMap();
		});
