<?php
session_start();
if(isset($_POST['invio']))
{
    $connection=new mysqli("localhost","root","","prova");
    
    $result=$connection->query("INSERT INTO percorsi (username) VALUES ('".$_SESSION['username']."')");
    if(!$result)
    {
        echo "<script>alert('Errore')</script>";
    }
    
    $result=$connection->query("SELECT Max(id) AS var FROM percorsi");
    if($result)
    {
        while($row = $result->fetch_assoc())
        {
            $id = $row['var'];
        }
        $result->close();
        $file = file_get_contents($_FILES['file']['tmp_name']);
        $exfile = explode("\n", $file);
        $punti = new stdClass();
        $punti -> arraypunti = array();
        foreach($exfile as $key => $str)
        {
            $efile = explode(",", $str);
            $result=$connection->query("INSERT INTO punti (username,data,ora,latitudine,longitudine,satelliti,precisione,velocita,idp) VALUES ('".$_SESSION['username']."','".$efile[0]."','".$efile[1]."','".$efile[2]."','".$efile[3]."','".$efile[4]."','".$efile[5]."','".$efile[6]."','".$id."')");
            if(!$result)
            {
                echo "<script>alert('Errore')</script>";
            }
            array_push($punti -> arraypunti, array("lat"=>$efile[2],"lng"=>$efile[3]));
        }
        setcookie('stringa', json_encode($punti));
    }
    else
    {
        echo "<script>alert('Errore')</script>";
    }
    $connection->close();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <!-- Basic Page Needs
      ================================================== -->
      <meta charset="utf-8">
      <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Awesomess - Portfolio Bootstrap Theme</title>
      <meta name="description" content="Your Description Here">
      <meta name="keywords" content="bootstrap themes, portfolio, responsive theme">
      <meta name="author" content="ThemeForces.Com">
      
      <!-- Favicons
      ================================================== -->
      <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
      <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
      <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
  
      <!-- Bootstrap -->
      <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
  
      <!-- Stylesheet
      ================================================== -->
      <link rel="stylesheet" type="text/css"  href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/responsive.css">
      
      <script type="text/javascript" src="js/modernizr.custom.js"></script>
  
      <link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300' rel='stylesheet' type='text/css'>
      <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
  
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>
          #table-wrapper 
          {
              position:relative;
          }
          #table-scroll 
          {
              height:240px;
              overflow:auto;  
              margin-top:20px;
          }
          #table-wrapper table 
          {
              width:100%;
              
          }
          #table-wrapper table * 
          {
              color:black;
          }
          #table-wrapper table thead th .text 
          {
              position:absolute;   
              top:-20px;
              z-index:2;
              height:20px;
              width:35%;
              border:1px solid red;
          }
      </style>
    </head>
    <body>
      <div id="tf-home">
          <div class="overlay">
              <div id="sticky-anchor"></div>
              <nav id="tf-menu" class="navbar navbar-default">
                  <div class="container">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand logo"> Petrache Marius & Pozza Paolo </a>
                      </div>
  
                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            
                            if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
                            {
                                echo "<li><a href='#tf-portfolio'>Portfolio</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='#tf-portfolio'>Ultimo Percorso</a></li>";
                            }
                            
                            if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
                            {
                                echo "<li><a href='#tf-about'>Informazioni</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='#tf-service'>Nuovo Percorso</a></li>";
                            }
                            
                            ?>
                          <li><a href="#tf-contact">Contattaci</a></li>
                            <?php
                            
                            if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
                            {
                                echo "<li><a href='login.php'>Login</a></li><li><a href='registrazione.php'>Registrati</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='account.php' id='account'>".$_SESSION['username']."</a></li><li><a href='index.php?logout=true'>Logout</a></li>";
                            }
                            
                            ?>
                        </ul>
                      </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
              </nav>
  
              <div class="container">
                  <div class="content">
                      <?php
                      if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
                      {
                          echo '<h1>We create systems</h1><h3>that communicates and connect people</h3><br><a href="#tf-contact" class="btn btn-primary my-btn">Contattaci</a><a href="#tf-portfolio" class="btn btn-primary my-btn2">Portfolio</a>';
                      }
                      else
                      {
                          echo '<h1>Il nostro sistema</h1><h3>che traccia i tuoi movimenti.</h3><br><a href="#tf-contact" class="btn btn-primary my-btn">Contattaci</a><a href="#tf-portfolio" class="btn btn-primary my-btn2">Ultimo percorso</a>';
                      }
                      ?>
                  </div>
              </div>
          </div>
      </div>
        <?php
        
        if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
        {
            echo "<div id='tf-service'><div class='container'><div class='col-md-4'><div class='media'><div class='media-left media-middle'><i class='fa fa-motorcycle'></i></div><div class='media-bod'y'><h4 class='media-heading'>Brand & Graphics Design</h4><p> testo 1</p></div></div></div><div class='col-md-4'><div class='media'><div class='media-left media-middle'><i class='fa fa-gears'></i></div><div class='media-body'><h4 class='media-heading'>Web Designer & Developer</h4<p> testo 2</p></div></div></div><div class='ol-md-4'><div class='media'><div class'media-left media-middle'><i class='fa fa-heartbeat'></i></div><div class='media-body'><h4 class='media-heading'>Business Consultant</h4><p> testo 3</p></div></div></div></div></div>";
        }
        else
        {
            echo "<div id='tf-service'><div class='container'><form action='index.php' method='post' enctype='multipart/form-data' style='text-align:center;'><br><h2 style='margin: 40px;'>Inserisci il file</h2><br><a class='btn btn-primary my-btn dark' style='margin:40px;' href=''><input type=file name='file'></a><br><button type='submit' name='invio' class='btn btn-primary my-btn dark' style='margin:40px;'>Invio</button></form></div></div>";
        }
        
        ?>
  
      <div id="tf-portfolio">
          <div class="container">
              <div class="section-title">
                  <?php
                  if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
                  {
                      echo "<h3>Il nostro prodotto</h3>";
                  }
                  else
                  {
                      echo "<h3>Ultimo percorso</h3>";
                  }
                  ?>
                  <hr>
              </div>
  
              <div class="space"></div>
              <?php
                            
              if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
              {
                  echo '<div class="row"><div class="col-md-4"><img src="img/09.jpg" class="img-responsive"></div><div class="col-md-4"><img src="img/02.jpg" class="img-responsive"></div><div class="col-md-4"><img src="img/03.jpg" class="img-responsive"></div></div><div class="row toppadding"><div class="col-md-4"><img src="img/04.jpg" class="img-responsive"></div><div class="col-md-4"><img src="img/05.jpg" class="img-responsive"></div><div class="col-md-4"><img src="img/06.jpg" class="img-responsive"></div></div>';
              }
              else
              {
              ?>
              <div id="map" style="width:100%;height:500px"></div>
              <script>
                  var cookiestring=RegExp("stringa[^;]+").exec(document.cookie);
                  var stringa = unescape(!!cookiestring ? cookiestring.toString().replace(/^[^=]+./,"") : "");
                  stringa = JSON.parse(stringa);
                  
                  function myMap() 
                  {
                      var myCenter = new google.maps.LatLng(stringa.arraypunti[0].lat, stringa.arraypunti[0].lng);
                      var mapCanvas = document.getElementById("map");
                      var mapOptions = {center: myCenter, zoom:15};
                      var map = new google.maps.Map(mapCanvas, mapOptions);
                      request(map);
                  }
                  
                  function request(map)
                  {
                      var punti = [];
                      for(var i = 0; i<stringa.arraypunti.length; i++)
                      {
                          var latlng = new google.maps.LatLng(stringa.arraypunti[i].lat, stringa.arraypunti[i].lng);
                          punti.push(latlng);
                      }
                      var snappedPolyline = new google.maps.Polyline({
                          path: punti,
                          strokeColor: 'black',
                          strokeOpacity: 1.0,
                          strokeWeight: 3
                      });
                      snappedPolyline.setMap(map);
                  }
              </script>
              <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0eUzC_no58hHDQ2rf2QIYDZOcWXflmAk&callback=myMap"></script>
              <?php
              }
              ?>
          </div>
      </div>
  
      <div id="tf-about">
          <div class="overlay">
              <div class="container" style="text-align:center">
                  <?php
                  if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
                  {
                      echo "<div class='row'><div class='col-md-6 col-md-offset-6'><h3>About Us</h3><br><p>testo 01.</p><p>testo 02.</p><br><a href='#tf-why-me' class='btn btn-primary my-btn dark'>Why Hire Me</a></div></div>";
                  }
                  else
                  {
                      echo "<h3>Punti precedenti</h3>";
                      $connection=new mysqli("localhost","root","","prova");
    
                      $result=$connection->query("SELECT Max(id) AS var FROM percorsi");
                      if($result)
                      {
                          while($row = $result->fetch_assoc())
                          {
                              $id = $row['var'];
                          }
                          $result->close();
                          
                          $result=$connection->query("SELECT * FROM punti WHERE idp<$id AND username=0'".$_SESSION['username']."'");
                          if($result)
                          {
                              echo "<div id='table-wrapper'><div id='table-scroll'><table style='text-align:left'><tr><th style='width: 100px;'>Data</th><th style='width: 100px;'>Ora</th><th style='width: 100px;'>Latitudine</th><th style='width: 100px;'>Longitudine</th><th style='width: 100px;'>N° satelliti</th><th style='width: 100px;'>Precisione</th><th style='width: 100px;'>Velocità km/h</th></tr>";
                              $i=0;
                              while($row = $result->fetch_assoc())
                              {
                                  echo "<tr><td style='width: 100px;'>".$row['data']."</td><td style='width: 100px;'>".$row['ora']."</td><td style='width: 100px;'>".$row['latitudine']."</td><td style='width: 100px;'>".$row['longitudine']."</td><td style='width: 100px;'>".$row['satelliti']."</td><td style='width: 100px;'>".$row['precisione']."</td><td style='width: 100px;'>".$row['velocita']."</td><td style='width: 100px;'><form><input type='hidden' name='valore' value='$i'><button class='btn btn-primary my-btn dark' name='visualizza'>Visualizza</button></form></td></tr>";
                                  $i++;
                              }
                              echo "</table></div></div>";
                              $result->close();
                          }
                          else
                          {
                              echo "<br>Non sono presenti punti precedentemente inseriti.";
                          }
                          
                      }
                      else
                      {
                          echo "<script>alert('Errore')</script>";
                      }
                      $connection->close();
                  }
                  
                  ?>
              </div>
          </div>
      </div>
  
      <div id="tf-why-me">
          <?php
          if(!isset($_SESSION['username']) AND !isset($_SESSION['password']))
          {
              echo "<div class='overlay'><div class='container'><div class='row'><div class='col-md-6'><h3>Why Hire Me</h3><br><ul class='list-inline why-me'><li><h4>I Do Brand that Sells</h4><p>Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p></li><li><h4>You will love my Designs</h4><p>Donec lacinia congue felis in faucibus. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p></li><li><h4>I Deliver on Time</h4><p>Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p></li></ul><a href='#tf-contact' class='btn btn-primary my-btn dark'>Contact</a></div></div></div></div>";
          }
          else
          {
              $connection=new mysqli("localhost","root","","prova");  
              $result=$connection->query("SELECT DISTINCT percorsi.id, punti. data, punti.ora, punti.username FROM percorsi INNER JOIN punti ON percorsi.id=punti.idp WHERE punti.username='".$_SESSION['username']."';");
              if($result->num_rows>0)
              {
                  echo "<div class='overlay' style='background-color:white'><div class='container' style='text-align:center;'><h3>Percorsi precedenti</h3><div id='table-wrapper'><div id='table-scroll'><table style='text-align:left'><tr><th style='width: 100px;'>Data</th><th style='width: 100px;'>Ora</th><th style='width: 100px;'>ID</th</tr>";
                  
                  $i=0;
                    
                  while($row = $result->fetch_assoc())
                  {
                      echo "<tr><td style='width: 100px;'>".$row['data']."</td><td style='width: 100px;'>".$row['ora']."</td><td style='width: 100px;'>".$row['id']."</td><td style='width: 100px;'><form><input type='hidden' name='valore' value='$i'><button class='btn btn-primary my-btn dark' name='visualizza'>Visualizza</button></form></td></tr>";
                      
                      $i++;
                  }
                  echo "</table></div></div></div></div>";
                
                  $result->close();
              }
              else
              {
                  echo "<div class='overlay' style='background-color:white'><div class='container' style='text-align:center;'><h3>Percorsi precedenti</h3><br>Non sono presenti percorsi precedentemente inseriti.</div></div>";
              }
              $connection->close();
          }
                                     
          ?>
      </div>
  
      <div id="tf-contact">
          <div class="container">
              <div class="section-title">
                  <h3>Contattaci</h3>
                  <hr>
              </div>
  
              <div class="space"></div>
  
              <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                      <form id="contact" method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                          <input type="text" class="form-control" name="nome" id="exampleInputEmail1" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" name="email" id="exampleInputPassword1" placeholder="Enter Email">
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="oggetto" id="exampleInputEmail1" placeholder="Enter Subject">
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" name="msg" rows="4" placeholder="Message"></textarea>
                        </div>
                                <?php

                                if(isset($_POST['contact']))
                                {
                                   /* $nome=$_POST['nome'];
                                    $email=$_POST['email'];
                                    $obj=$_POST['oggetto'];
                                    $msg=$_POST['msg'];*/

                                }

                                ?>
                        <button type="submit" class="btn btn-primary my-btn dark" name="contact">Submit</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  <!--
    Parte per acquisire informazioni inserite nella forma e contattare l'azienda.
    -->
  
     
      <nav id="tf-footer">
          <div class="container">
               <div class="pull-left">
                  <p></p>
              </div>
              <div class="pull-right"> 
                  <ul class="social-media list-inline">
                      <li><p>Follow us</p></li>
                      <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                      <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                      <li><a href="#"><span class="fa fa-pinterest"></span></a></li>
                      <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                      <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
                      <li><a href="#"><span class="fa fa-behance"></span></a></li>
                  </ul>
              </div>
          </div>
      </nav>
   

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script type="text/javascript" src="js/bootstrap.js"></script>

      <!-- Javascripts
      ================================================== -->
      <script type="text/javascript" src="js/main.js">
      </script>

  </body>
</html>

<?php

function logout()
{
    session_unset();
    echo "<script>alert('Logout riuscito! Ritorno alla home.');window.location.href='index.php';</script>"; 
}

if(isset($_GET['logout']))
{
    logout();
}

?>