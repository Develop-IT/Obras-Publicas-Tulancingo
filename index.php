<!DOCTYPE html>

<html lang="es">

<head>

  <?php

    include("headers.php");
    if (!isset($_SESSION["username"])) {
          header('Location: login.php ');
        }
    if (isset($_GET["show"])) {
      switch ($_GET["show"]) {
        case 'baches':
          $query="select id_complaint,lat_complaint,lon_complaint,desc_complaint,id_complaint_status from opt_complaint where id_complaint_type=2;";
          break;
        case 'alumbrado':
          $query="select id_complaint,lat_complaint,lon_complaint,desc_complaint,id_complaint_status from opt_complaint where id_complaint_type=1;";
          break;
        case 'obras':
          $query="select id_complaint,lat_complaint,lon_complaint,desc_complaint,id_complaint_status from opt_complaint where id_complaint_type=3;";
          break;
        case 'otros':
        $query="select id_complaint,lat_complaint,lon_complaint,desc_complaint,id_complaint_status from opt_complaint where id_complaint_type=4;";
          break;
        default:
          $query="select id_complaint,lat_complaint,lon_complaint,desc_complaint,id_complaint_status from opt_complaint where id_complaint_type=1;";
          break;
      }
    }
    else{
      $query="select id_complaint,lat_complaint,lon_complaint,desc_complaint,id_complaint_status from opt_complaint where id_complaint_type=1;";
    }
  ?>


</head>
  <body class="hold-transition skin-green sidebar-mini" style="height:100%;">
    <div class="wrapper">

      <?php
        include("sidebar.php");
      ?>
       <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         
            
              <div id="map-container" class="col-md-12"></div>

         
            
         
        </div><!-- Content Wrapper-->
        
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- Main Wrapper -->

    <script type="text/javascript">
      
     
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map-container'), {
          zoom: 14,
          center: {lat: 20.090473, lng: -98.3593561}
        });

        setMarkers(map);
      }
      var infos = [];
      // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.
      var places = [
        <?php
          $result=mysqli_query($con,$query) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
            echo "['".htmlentities(utf8_encode($row["desc_complaint"]), 0, 'UTF-8')."',".$row["lat_complaint"].",".$row["lon_complaint"].",".$row["id_complaint"].",".$row["id_complaint_status"]."],";
          }
        ?>
        
      ];

      function setMarkers(map) {
        //var infowindow = new google.maps.InfoWindow();
        for (var i = 0; i < places.length; i++) {
          var place = places[i];
          var iconUrl = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
          switch(place[4]){
              case 1:
                iconUrl= "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
                break;
              case 2:
                iconUrl= "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
                break;
              case 3:
                iconUrl= "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
                break;

            }
          var marker = new google.maps.Marker({
            position: {lat: place[1], lng: place[2]},
            map: map,
            title: place[0],
            zIndex: place[3],
            icon:iconUrl
            
          });
          var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">Obras P&uacute;blicas Tulancingo</h3>'+
            '<div id="bodyContent">'+
            '<p>'+place[0]+'</p>'+
            '<p><a href="detail.php?id='+place[3]+'">'+
            'Detalles</a> '+
            '.</p>'+
            '</div>'+
            '</div>';
              var infowindow = new google.maps.InfoWindow();
           /*var infowindow = new google.maps.InfoWindow({
              content: contentString
            });
           marker.addListener('click', function() {
              infowindow.open(map, marker);
            });*/
          /*google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            
            infowindow.setContent(places[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));*/
        google.maps.event.addListener(marker,'click', (function(marker,contentString,infowindow){ 
              return function() {
              
              /* close the previous info-window */
             closeInfos();
              
                 infowindow.setContent(contentString);
                 infowindow.open(map,marker);
              
              /* keep the handle, in order to close it on next click event */
         infos[0]=infowindow;
              
              };
          })(marker,contentString,infowindow)); 
        }
      }
      function closeInfos(){
 
   if(infos.length > 0){
 
      /* detach the info-window from the marker ... undocumented in the API docs */
      infos[0].set("marker", null);
 
      /* and close it */
      infos[0].close();
 
      /* blank the array */
      infos.length = 0;
   }
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq_R7PbzYdy35unqU1CdiCvHhHjyfANbU&callback=initMap" async defer></script>
    <?php
    	include("footer.php");
    ?>
    <script type="text/javascript">
          <?php
            if (isset($_GET["show"])) {
              echo 'var type="'.$_GET["show"].'"';
            }
            else{
              echo 'var type="baches"';
            }
            
          ?>;
          
          $("#menu_"+type).addClass("active");
    </script>
  </body>
</html>