<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_banco=$_GET["cod_banco"]; $fecha=$_GET["fecha"]; $codigo_mov=$_GET["codigo_mov"]; $tipod=$_GET["tipod"]; $tipoh=$_GET["tipoh"];
$sfechad=formato_aaaammdd($fecha); $montod=$_GET["montod"]; $montoh=$_GET["montoh"]; $solop=$_GET["solop"];
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
$resultado=pg_exec($conn,"SELECT BORRAR_BAN035('$codigo_mov')"); $error=pg_errormessage($conn); $error=substr($error, 0, 61);
$Sql="SELECT CARGA_MOV_BAN035('$codigo_mov','$sfechad','$cod_banco')";
$Sql="SELECT CARGA_MOV_TIPO_BAN035('$codigo_mov','$sfechad','$cod_banco','$tipod','$tipoh')";
$resultado=pg_exec($conn,$Sql); $error=pg_errormessage($conn); $error=substr($error, 0, 61); 
pg_close($conn);
?>
<iframe src="Det_carga_libros.php?codigo_mov=<?php echo $codigo_mov?>&cod_banco=<?php echo $cod_banco?>&fecha=<?php echo $fecha?>&solop=<?php echo $solop?>&monto_d=<?php echo $montod?>&monto_h=<?php echo $montoh?>"  width="940" height="350" scrolling="auto" frameborder="1"> </iframe>
