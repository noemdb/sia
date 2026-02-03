<?php include ("../class/conect.php"); include ("../class/funciones.php");

echo "ESPERE ACTUALIZANDO EXISTENCIA....","<br>";
$conn = pg_connect("host=".$host." port=5432 password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)){ ?> <script language="JavaScript">  muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script> <?php }
 else{
  $resultado=pg_exec($conn,"SELECT actualiza_existencia()");   $error=pg_errormessage($conn);  $error=substr($error, 0, 61);
  if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error." ACT "; ?>'); </script> <?php }
  
  ?> <script language="JavaScript">  muestra('PROCESO FINALIZADO'); </script> <?php 
}pg_close($conn);?> <script language="JavaScript">javascript:window.close();</script>