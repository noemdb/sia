<?php include ("../class/conect.php"); include ("../class/funciones.php");
$password=$_GET["password"];$user=$_GET["user"]; $dbname=$_GET["dbname"];  $criterio=$_GET["criterio"]; 
?><iframe src="Det_nom_usuarios.php?criterio=<?php echo $criterio?>"  width="940" height="350" scrolling="auto" frameborder="1"> </iframe>
<?php pg_close($conn);?>