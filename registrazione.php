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
      <link rel="stylesheet" type="text/css"  href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/responsive.css">
      <link rel="stylesheet" type="text/css" href="css/dropdownlogin.css">
      
      <script type="text/javascript" src="js/modernizr.custom.js"></script>
  
      <link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300' rel='stylesheet' type='text/css'>
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
            <div class="overlay" style="height: 100vh">
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
  
                <div class="container">
                    <div class="content">
                        <form method="post" action="registrazione.php">
                            <label style="width:150px;"><h3>Username:</h3><input type="text" name="username" id="username" required onchange="ControlloUE('username', this.value)" style="color: #000"></label><br>
                            <label style="width:150px;"><h3>Email:</h3><input type="email" name="email" id="email" required onchange="ControlloUE('email', this.value)" style="color: #000"></label><br>
                            <label style="width:150px;"><h3>Password:</h3><input type="password" id="pass1" name="pass1" required style="color: #000"></label><br>
                            <label style="width:150px;"><h3>Conferma password:</h3><input type="password" onchange="Controllo()" required id="pass2" name="pass2" style="color: #000"></label><br>
                            <button type="submit" id="bot" required name="Invio" class="btn btn-primary my-btn">Invio</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
   
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.js"></script>
  
        <!-- Javascripts
        ================================================== -->
        <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>

<?php

if(isset($_POST['Invio']))
{
    $username = $_POST['username'];
    $password = $_POST['pass1'];
    $pass = md5($password);
    $email = $_POST['email'];
    $connection=new mysqli("localhost","root","","prova");
    $result=$connection->query("INSERT INTO utenti (username, email, password) VALUES ('".$username."','".$email."', '".$pass."')");
    if($result)
    {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $pass;
        $_SESSION['privilegi'] = 'user';
        echo "<script>alert('Registrazione effettuata!');window.location.href='https://index.php';</script>"; 
        $result->close();
    }
    else
    {
        echo "<script>alert('Errore')</script>";
    }
    echo $username . $password;
    $connection->close();
}

?>