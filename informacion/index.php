<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Informaci&oacute;n</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400' rel='stylesheet' type='text/css'>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
    <style type="text/css">
      .texto_roboto{
        font-family: 'Roboto', sans-serif;
        color: #0D0C0C;
      }
      #text_info{
        
      }
    </style>
	</head>
	<body>
<header style="background-color: #000044;" class="navbar navbar-bright navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      
      
    </div>
    
  </div>
</header>

<div id="masthead">  
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1>Obras Publicas
          <p class="lead"></p>
        </h1>
      </div>
      <div class="col-md-5" style="background-color: #000044;">
        <div class="well " style="background-color: #000044;border-color: #000044;"> 
          <div class="row">
            <div class="col-sm-12">

            </div>
          </div>
        </div>
      </div>
    </div> 
  </div><!-- /cont -->
  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="top-spacer"> </div>
      </div>
    </div> 
  </div><!-- /cont -->
  
</div>


<div class="container">
  <div class="row">
    
    <div class="col-md-12"> 
      
      <div class="panel">
        <div class="panel-body">

          <!--/stories-->
          <div class="row">    
            
            <div class="col-md-10 col-sm-9">
              <h3>Apartado de informacion.</h3>
              <div class="row">
                <div class="col-xs-9">
                  <h4><span class="label label-default" id="title">Inicio</span></h4><h4>
                  
                  
                  
                  </h4>
                  <span id="text_info"><h4>Dentro de esta seccion de la aplicacion podras leer informacion acerca de los procesos asi como las leyes que pueden apoyarte.</h4></span>
                  </div>
                <div class="col-xs-3"></div>
              </div>
              <br><br>
            </div>
          </div>
          <hr>
          <button id="mnu_index" class="btn btn-primary">Inicio</button>
          <button id="mnu_laws" class="btn btn-primary">Leyes</button>
          <button id="mnu_facilities" class="btn btn-primary">Departamento</button>
          

          <!--/stories-->  
        </div>
      </div>
                                                                                       
	                                                
                                                      
   	</div><!--/col-12-->
  </div>
</div>

		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
    <script>
    $( document ).ready(function() {
      $("#mnu_index").css("background-color","#000044");
      function limpiarColor(){
          
        $("#mnu_index").css("background-color","#428bca");
        $("#mnu_laws").css("background-color","#428bca");
        $("#mnu_facilities").css("background-color","#428bca");
        $("#mnu_times").css("background-color","#428bca");
      }
      $("#mnu_laws").click(function(){
          $("#title").html("");
          $("#title").html("Leyes");
          $("#text_info").html("");
          $("#text_info").load("laws.php #laws");
          $("#text_info").addClass("texto_roboto");
          limpiarColor();
          $("#mnu_laws").css("background-color","#000044");

      });
      $("#mnu_index").click(function(){
          $("#title").html("");
          $("#title").html("Inicio");
          $("#text_info").html("");
          $("#text_info").load("inicio.php #index");
          limpiarColor();
          $("#mnu_index").css("background-color","#000044");
          

      });
      $("#mnu_facilities").click(function(){
          $("#title").html("");
          $("#title").html("Departamento");
          $("#text_info").html("");
          $("#text_info").load("departamento.php #facilities");
          limpiarColor();
          $("#mnu_facilities").css("background-color","#000044");
          

      });
      $("#mnu_times").click(function(){
          $("#title").html("");
          $("#title").html("Departamento");
          $("#text_info").html("");
          $("#text_info").load("departamento.php #facilities");
          limpiarColor();
          $("#mnu_times").css("background-color","#000044");
          

      });
    });
    </script>
	</body>
</html>