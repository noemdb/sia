<?php include ("../class/conect.php"); include ("../class/funciones.php");
$password=$_GET["password"];$user=$_GET["user"]; $dbname=$_GET["dbname"];  $codigo_mov=$_GET["codigo_mov"]; 
?><iframe src="Det_unid_solic.php?codigo_mov=<?php echo $codigo_mov?>"  width="940" height="350" scrolling="auto" frameborder="1"> </iframe>
<?php pg_close($conn);?>