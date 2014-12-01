/*
* Färgkoder
* #CCC
* #EA005A
* #969
*/

function getStyles(){
    var styles = [{featureType:"all", stylers:[{saturation:-20}]},
		  {featureType:"road",elementType: "geometry",stylers:[{hue:"#EA005A"},	{saturation:50}]},
		  {featureType: "road",elementType: "labels",stylers:[{hue:"#969"},
{saturation:50}]}
		 ];
    return styles;    
}

function bindInfoWindow(marker, map, infoWindow, html, textcolor, backgroundcolor) {
    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html, textcolor, backgroundcolor);
        infoWindow.open(map, marker);
    });
}

function doNothing(){}

function makeHTML(i, lat, lng){
    var placex = (lat!=0)?lat:obj[i].lat;
    var placey = (lng!=0)?lng:obj[i].lng;
    var name = "<p class='kontorsnamn'>" + obj[i].kontorsnamn + "</p>";
    var address = "<p class='address'>" + obj[i].gata + "<br />" + obj[i].stad + "</p>";
    var oppet = (obj[i].oppet == null)? "":"<p class='oppet'>Öppettider: <br />" + obj[i].oppet + "</p>";
    var stn = "<p class='stn'>Antal stationer: " + obj[i].stn + "</p>";
    var image = (obj[i].logurl == null)? "":"<img class='imge' src='"+ obj[i].logurl + "' width='"+obj[i].logbredd+"px' height='"+obj[i].loghojd+"px' />";
    var allminfo = (obj[i].allminfo == null)? "":"<p class='allminfo'>" + obj[i].allminfo + "</p>";
    var hemsida = (obj[i].hemsida == null)? "":"<p class='hemsida'><a href = '" + obj[i].hemsida + "' target = '_blank'>Vill du veta mer?</a></p>";
    var tele = (obj[i].tele == null)? "":"<p class='tele'>" + obj[i].tele + "</p>";
    var vagvisning = "<p class='hemsida'><a href='javascript:void(0)' onclick='cmap.direction("+placex+","+placey+","+obj[i].lat+","+obj[i].lng+");'>Vägbeskrivning</a></p>";


    var html = image + "<div id='info_content'>" + name + address + allminfo + oppet + stn + tele + hemsida + vagvisning + "</div>";
    return html;
}

var cmap;
(function(){
    document.addEventListener('DOMContentLoaded', function(){
	cmap = new Cmap({el:document.getElementById('googleMap')});
    });
})();

Cmap.prototype.starting = function(){
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&v=3&sensor=true&callback=cmap.init';
    document.getElementsByTagName('head')[0].appendChild(script);
}

function Cmap(opt_opts) {
    this.mapReady = false;
    this.opt = opt_opts;
    this.mapid = this.opt.el;
    this.coords = {lat: 0, lng: 0};
    this.zoom = 1;
    this.starting();
}

Cmap.prototype.init = function() {
    var self = this;
    //ta en titt på navigator.geolocation.watchPosition till mobilversionen
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
	    function(position) {self.updateLocation(position);}, 
	    function(){self.setLocation();}
	);
    } 
    else {
        this.setLocation();
    }
};

Cmap.prototype.updateLocation = function(loc){
    this.coords.lat = loc.coords.latitude;
    this.coords.lng = loc.coords.longitude;
    this.zoom = 12;
    this.initialize();
}

Cmap.prototype.setLocation = function(){
    this.zoom = 6;
    this.initialize();
}

Cmap.prototype.initialize = function(){
    var locx = (this.coords.lat != 0)? this.coords.lat:63.8250;
    var locy = (this.coords.lng != 0)? this.coords.lng:20.2639;
    var options = {
	zoom:this.zoom,
	center: new google.maps.LatLng(locx, locy),
	mapTypeId: google.maps.MapTypeId.HYBRID,
	mapTypeControl: true,
	scaleControl: true,
	zoomControlOptions: {
	    style: google.maps.ZoomControlStyle.DEFAULT
	},
	overviewMapControl: true
    };
    this.mapReady = true;
    this.infoWindow = new (InfoCBox())();
    this.markers = [];
    this.map = new google.maps.Map(this.mapid, options);
    this.map.setOptions({styles: getStyles()});
    this.directionsDisplay = new google.maps.DirectionsRenderer();
    this.directionsDisplay.setMap(this.map);
    var obj_length = obj.length;
    var lat, lng;
    for (var i = 0; i < obj_length; i++) {
	lat = parseFloat(obj[i].lat);
	lng = parseFloat(obj[i].lng);
	var point = new google.maps.LatLng(lat, lng);
	var htm = makeHTML(i, this.coords.lat, this.coords.lng);
	var icon = {url:obj[i].imgurl, size:new google.maps.Size(32,32)};
	var marker = new google.maps.Marker({
	    map:this.map,
	    position:point,
	    icon:icon
	});
	var fcolor = obj[i].forecolor;
	var bcolor = obj[i].backcolor;
	bindInfoWindow(marker, this.map, this.infoWindow, htm, fcolor, bcolor);
    }
}

Cmap.prototype.direction = function(flat,flng,tlat,tlng){
    var directionsService = new google.maps.DirectionsService();
    var self = this;
    var request = {
	origin:new google.maps.LatLng(flat,flng),
	destination:new google.maps.LatLng(tlat,tlng),
	travelMode: google.maps.TravelMode.WALKING
    };
    directionsService.route(request, function(result, status) {
	if (status == google.maps.DirectionsStatus.OK) {
	    self.directionsDisplay.setDirections(result);
	}
    });
}

function InfoCBox(){
    function makeHead(){
	return "<img src='image/close.png' draggable='false' class='iw_close'>";
    }
    var Cbox = function(){
	this.container = document.createElement('div');
        this.container.classList.add('infowindow');
	this.container.inDiv = document.createElement('div');
	this.container.innerDiv = document.createElement('div');
	this.container.closeDiv = document.createElement('div');
	this.container.inDiv.classList.add('inDiv');
	this.container.innerDiv.classList.add('innerDiv');
	this.container.closeDiv.classList.add('closeDiv');
	this.container.appendChild(this.container.inDiv);
	this.container.appendChild(this.container.innerDiv);
	this.container.appendChild(this.container.closeDiv);

	var arrowDiv = document.createElement('div');
	var containerDiv = document.createElement('div');
	arrowDiv.classList.add('arrowDiv');
	containerDiv.classList.add('containerDiv');
	this.container.inDiv.appendChild(containerDiv);
	this.container.inDiv.appendChild(arrowDiv);

	var arrowDivleft = document.createElement('div');
	var arrowDivright = document.createElement('div');
	arrowDivleft.classList.add('arrowDivleft');
	arrowDivright.classList.add('arrowDivright');
	arrowDiv.appendChild(arrowDivleft);
	arrowDiv.appendChild(arrowDivright);

	var aDcrocleft = document.createElement('div');
	aDcrocleft.classList.add('aDcrocleft');
	arrowDivleft.appendChild(aDcrocleft);

	var aDcrocright = document.createElement('div');
	aDcrocright.classList.add('aDcrocright');
	arrowDivright.appendChild(aDcrocright);

	var contentDiv = document.createElement('div');
	contentDiv.classList.add('contentDiv');
	this.container.innerDiv.appendChild(contentDiv);
	this.hooks = {cont:containerDiv, inne:contentDiv, cright:aDcrocright, cleft:aDcrocleft};

	this.container.closeDiv.innerHTML = makeHead();
        this.layer = null;
        this.marker = null;
        this.position = null;
    }
    
    Cbox.prototype = new google.maps.OverlayView();
    
    Cbox.prototype.onAdd = function(){
	this.layer = this.getPanes().floatPane;
	this.layer.appendChild(this.container);
	this.container.getElementsByClassName('iw_close')[0].addEventListener('click', function(){
            this.close();
        }.bind(this), false);
        setTimeout(this.panToView.bind(this), 200);
    }

    Cbox.prototype.draw = function(){
	var markerIcon = this.marker.getIcon(),
        cHeight = this.container.offsetHeight + markerIcon.size.height,
        cWidth = this.container.offsetWidth / 2;
        this.position = this.getProjection().fromLatLngToDivPixel(this.marker.getPosition());
        this.container.style.top = this.position.y - cHeight+'px';
        this.container.style.left = this.position.x - cWidth+'px';
    }

    Cbox.prototype.panToView = function(){
	var position = this.position,
	latlng = this.marker.getPosition(),
	top = parseInt(this.container.style.top, 10),
	cHeight = position.y - top,
	cWidth = this.container.offsetWidth / 2,
	map = this.getMap(),
	center = map.getCenter(),
	bounds = map.getBounds(),
	degPerPixel = (function(){
            var degs = {},
            div = map.getDiv(),
            span = bounds.toSpan();
	    
            degs.x = span.lng() / div.offsetWidth;
            degs.y = span.lat() / div.offsetHeight;
            return degs;
	})(),
	infoBounds = (function(){
            var infoBounds = {};
	    
            infoBounds.north = latlng.lat() + cHeight * degPerPixel.y;
            infoBounds.south = latlng.lat();
            infoBounds.west = latlng.lng() - cWidth * degPerPixel.x;
            infoBounds.east = latlng.lng() + cWidth * degPerPixel.x;
            return infoBounds;
	})(),
	newCenter = (function(){
            var ne = bounds.getNorthEast(),
            sw = bounds.getSouthWest(),
            north = ne.lat(),
            east = ne.lng(),
            south = sw.lat(),
            west = sw.lng(),
            x = center.lng(),
            y = center.lat(),
            shiftLng = ((infoBounds.west < west) ? west - infoBounds.west : 0) +
		((infoBounds.east > east) ? east - infoBounds.east : 0),
            shiftLat = ((infoBounds.north > north) ? north - infoBounds.north : 0) +
		((infoBounds.south < south) ? south - infoBounds.south : 0);
	    
            return (shiftLng || shiftLat) ? new google.maps.LatLng(y - shiftLat, x - shiftLng) : void 0;
	})();
	
	if (newCenter){
            map.panTo(newCenter);
	}
    }
    
    Cbox.prototype.setContent = function(content, textcolor, backgroundcolor){
	this.hooks.inne.innerHTML = content;
	this.hooks.inne.style.color = textcolor;
	this.hooks.cont.style.backgroundColor = backgroundcolor;
	this.hooks.cright.style.backgroundColor = backgroundcolor;
	this.hooks.cleft.style.backgroundColor = backgroundcolor;
    }
    
    Cbox.prototype.getContent = function () {  return this.container; }
    Cbox.prototype.show = function (){ this.isHidden_ = false; this.container.style.visibility = "visible"; }
    Cbox.prototype.hide = function (){ this.isHidden_ = true; this.container.style.visibility = "hidden"; }
    
    Cbox.prototype.open = function (map, marker) {
	this.marker = marker;
	this.setMap(map);
    }
    Cbox.prototype.close = function (){
	this.setMap(null);
    }
    
    Cbox.prototype.onRemove = function(){
	this.layer.removeChild(this.container);
    }
    return Cbox;
}
