<meta charset=utf-8 />
  <title>Mobow</title>
  <link rel="stylesheet" type="text/css" media="screen" href="css/index.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/menu.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/footer.css" />
  <link rel="icon" type="image/png" size="64x64" href="image/icon.png"></link>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
  </script>
 <script>
   function initialize()
   {
   var mapProp = {
    scrollwheel: false,
  center:new google.maps.LatLng(63.8250,20.2639),
   zoom:5,
   mapTypeId:google.maps.MapTypeId.ROADMAP
   };
   var map=new google.maps.Map(document.getElementById("googleMap")
   ,mapProp);
   
   var image = 'image/icon.png';
  var myLatLng = new google.maps.LatLng(63.8250, 20.2639);
  var beachMarker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: image
  });   
   
   }
   google.maps.event.addDomListener(window, 'load', initialize);
 </script>