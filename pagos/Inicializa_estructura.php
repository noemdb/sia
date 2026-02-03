<?php include ("../class/conect.php");  include ("../class/funciones.php"); error_reporting(E_ALL);
$codigo_mov=$_GET["codigo_mov"];
$url="Det_inc_cod_est.php?codigo_mov=".$codigo_mov;echo "ESPERE POR FAVOR INICIALIZANDO....","<br>";$error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{ $sSQL="Select * from PRE026 WHERE codigo_mov='$codigo_mov'";   $resultado=pg_exec($conn,$sSQL); $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGOS PRESUPUESTARIO SNO EXISTE EN LA ESTRUCTURA');</script> <?php }
   else{ $sSQL="update PRE026 set monto=0 WHERE codigo_mov='$codigo_mov'";
     $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn);  $error=substr($error, 0, 91);   if (!$resultado){?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
  }
}
pg_close($conn);  error_reporting(E_ALL ^ E_WARNING);?><script language="JavaScript"> LlamarURL('<?php echo $url;?>'); </script>