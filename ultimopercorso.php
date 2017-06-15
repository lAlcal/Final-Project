<?php 
session_start();
$connection=new mysqli("localhost","root","","prova");
    
$result=$connection->query("SELECT Max(id) AS var FROM percorsi WHERE username='".$_SESSION['username']."'");
if($result)
{
    while($row = $result->fetch_assoc())
    {
        $id = $row['var'];
    }
    $result->close();
    
    $result=$connection->query("SELECT * FROM punti WHERE idp=$id AND username='".$_SESSION['username']."'");
    if($result)
    {
        echo "<div id='table-wrapper' style='text-align:center; margin-left:40px;'><div id='table-scroll'><table style='text-align:left'><tr><th style='width: 100px;'>Data</th><th style='width: 100px;'>Ora</th><th style='width: 100px;'>Latitudine</th><th style='width: 100px;'>Longitudine</th><th style='width: 100px;'>N° satelliti</th><th style='width: 100px;'>Precisione</th><th style='width: 100px;'>Velocità km/h</th></tr>";
        
        while($row = $result->fetch_assoc())
        {
            echo "<tr><td style='width: 100px;'>".$row['data']."</td><td style='width: 100px;'>".$row['ora']."</td><td style='width: 100px;'>".$row['latitudine']."</td><td style='width: 100px;'>".$row['longitudine']."</td><td style='width: 100px;'>".$row['satelliti']."</td><td style='width: 100px;'>".$row['precisione']."</td><td style='width: 100px;'>".$row['velocita']."</td></tr>";
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
?>