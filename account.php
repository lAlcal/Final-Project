<?php
session_start();
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
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css"  href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/responsive.css">
        
        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        
        <!--<link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body>
        <script>
            
            function avatar()
            {
                var div = document.getElementById("div").innerHTML= "<form action='account.php' method='post' enctype='multipart/form-data'><br><h2 style='margin: 40px;'>Cambia immagine</h2><br><a class='btn btn-primary my-btn dark' style='margin:40px;' href=''><input type=file name='immagine'></a><br><button type='submit' name='invio' class='btn btn-primary my-btn dark' style='margin:40px;'>Invio</button></form>";
            }
            
            function impostazioni()
            {
                var div = document.getElementById("div").innerHTML= '<button type="button" style="width:210px; margin:50px;" name="Cu" class="btn btn-primary my-btn dark" onclick="CU()">Cambia Username</button><br><button type="button" style="width:210px; margin:50px;" name="Cp" class="btn btn-primary my-btn dark" onclick="CP()">Cambia Password</button><br><button type="button" style="width:210px; margin:50px;" name="Ce" class="btn btn-primary my-btn dark" onclick="CE()">Cambia Email</button>';
            }
            
            function Up()
            {
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET", "ultimopercorso.php", true);
                xhttp.onreadystatechange = function()
                {
                    var div = document.getElementById("div").innerHTML= this.response;
                }
                
                xhttp.send(); 
            }
            
            function CU()
            {
                var div = document.getElementById("div").innerHTML= "<form action='account.php' method='post'>Nuovo username:<input type='text' style='width:210px; margin:50px; background-color:#2F937B;' id='username' name='username' class='btn btn-primary my-btn dark' onchange='ControlloUE(\"username\", this.value)' required><br><button type='submit' name='CambiaU' style='width:210px; margin:50px;' id='bot' class='btn btn-primary my-btn dark'>Cambia</button></form>";
            }
            
            function CP()
            {
                var div = document.getElementById("div").innerHTML= "<form action='account.php' method='post'><label style='width:300px;'>Nuovo password:<input type='password' style='width:210px; margin:50px; background-color:#2F937B;' id='pass1' name='pass1' class='btn btn-primary my-btn dark' required></label><br><label style='width:300px;'>Conferma password:<input type='password' style='width:210px; margin:50px; background-color:#2F937B;' id='pass2' name='pass2' class='btn btn-primary my-btn dark' onchange='Controllo()' required></label><br><button type='submit' name='CambiaP' style='width:210px; margin:50px;' id='bot' class='btn btn-primary my-btn dark'>Cambia</button></form>";
            }
            
            function CE()
            {
                var div = document.getElementById("div").innerHTML= "<form action='account.php' method='post'>Nuova email:<input type='email' style='width:210px; margin:50px; background-color:#2F937B;' id='email' name='email' class='btn btn-primary my-btn dark' onchange='ControlloUE(\"email\", this.value)' required><br><button type='submit' name='CambiaE' style='width:210px; margin:50px;' id='bot' class='btn btn-primary my-btn dark'>Cambia</button></form>";
            }
            
            function Controllo() 
            {
                var pass1 = document.getElementById("pass1").value;
                var pass2 = document.getElementById("pass2").value;
                if (pass1 != pass2) 
                {
                    alert("Le password non corrispondono");
                    document.getElementById("pass2").style.borderColor = "#E34234";
                    document.getElementById("bot").disabled = true;
                }
                else
                {
                    document.getElementById("bot").disabled = false;
                }
            }
            
            function ControlloUE(campo, valore)
            {
                var xhttp = new XMLHttpRequest();
                document.getElementById("bot").disabled = false;
                xhttp.onreadystatechange = function()
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        if(this.response == true)
                        {
                            document.getElementById("bot").disabled = true;
                            if(campo == 'username')
                            {
                                alert("Username già usato");
                                document.getElementById("username").style.borderColor = "#E34234";
                            }
                            if(campo == 'email')
                            {
                                document.getElementById("email").style.borderColor = "#E34234";
                                alert("Email già usata");
                            }
                        }
                        else
                        {
                            document.getElementById("bot").disabled = false;
                        }
                    }
                };
                xhttp.open("GET", "controllo.php?campo="+campo+"&valore="+valore, true);
                xhttp.send();
            }
        </script>
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
                                <li><a href="index.php">Home</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
                
                <div class="container" style="height:100vh;">
                    <div class="content">
                        <div style="height:50vh; z-index:-1; background-color:whitesmoke; padding-top: 20px; padding-bottom:20px">
                            <nav class="cd-side-nav" style="width:300px">
                                <ul><li><button type="button" style="width:210px" class="btn btn-primary my-btn dark" name="avatar" id="avatar" onclick="avatar()">
                                    
                                    <?php
                                    
                                    $connection=new mysqli("localhost","root","","prova");
                                    $result=$connection->query("SELECT immagine FROM utenti WHERE username='".$_SESSION['username']. "' AND password ='".$_SESSION['password']."'");
                                    if($result)
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            $img = $row['immagine'];
                                            echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['immagine']).'" height="150px" width="150px">';
                                        }
                                        $result->close();
                                    }
                                    else
                                    {
                                        echo "<script>alert('Errore')</script>";
                                    }
                                    $connection->close();
                                    
                                    ?>
                                    
                                    </button></li></ul>
                                <ul><li><button type="button" style="width:210px" name="Impostazioni" class="btn btn-primary my-btn dark" id="impostazioni" onclick="impostazioni()">Impostazioni</button></li></ul>
                                <ul><li><button type="button" style="width:210px" name="UltimiPercorsi" class="btn btn-primary my-btn dark" id="Up" onclick="Up()">Ultimo percorso</button></li></ul>
                                <ul><li><form action="registrazione.php" method="post"><button type="submit" style="width:210px" name="Esci" class="btn btn-primary my-btn dark">Esci</button></form></li></ul>
                            </nav>
                            <div style="margin-left:300px; border-left: thick solid #000; color: #000; width:750px; height:440px;" id="div">
                                <button type="button" style="width:210px; margin:50px;" name="cambiausername" class="btn btn-primary my-btn dark" onclick="CU()">Cambia Username</button><br>
                                <button type="button" style="width:210px; margin:50px;" name="cambiapassword" class="btn btn-primary my-btn dark" onclick="CP()">Cambia Password</button><br>
                                <button type="button" style="width:210px; margin:50px;" name="cambiaemail" class="btn btn-primary my-btn dark" onclick="CE()">Cambia Email</button>
                            </div>
                        </div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">           </script>
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

function Logout()
{
    session_unset();
    echo "<script>alert('Logout riuscito! Ritorno alla home.');window.location.href='index.php';</script>"; 
}

if(isset($_GET['Esci']))
{
    Logout();
}

if(isset($_POST['invio']))
{
    $image = addslashes(file_get_contents($_FILES['immagine']['tmp_name']));
    
    $connection=new mysqli("localhost","root","","prova");
    $result=$connection->query("UPDATE utenti SET immagine='".$image."' WHERE username='".$_SESSION['username']. "' AND password ='".$_SESSION['password']."'");
    if(!$result)
    {
        echo "<script>alert('Errore')</script>";
    }
    $connection->close();
    echo "<script>window.location.href='account.php';</script>"; 
}

if(isset($_POST['CambiaU']))
{
    $username = $_POST['username'];
    echo $username;
    $connection=new mysqli("localhost","root","","prova");
    $result=$connection->query("UPDATE utenti SET username='".$username."' WHERE username='".$_SESSION['username']. "' AND password ='".$_SESSION['password']."'");
    if($result)
    {
        $_SESSION['username'] = $username;
    }
    else
    {
        echo "<script>alert('Errore')</script>";
    }
    $connection->close();
    echo "<script>window.location.href='account.php';</script>"; 
}

if(isset($_POST['CambiaP']))
{
    
}

if(isset($_POST['CambiaE']))
{
    
}

?>