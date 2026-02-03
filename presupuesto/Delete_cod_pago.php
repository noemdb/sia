<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_presup=$_GET["codigo"];$cod_fuente=$_GET["fuente"];$codigo_mov=$_GET["codigo_mov"];$ref_imput_presu=$_GET["ref_imput_presu"];
$url="Det_inc_pagos.php?codigo_mov=".$codigo_mov;echo "ESPERE POR FAVOR ELIMINANDO....","<br>";$error=0;
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{
  $sSQL="Select * from PRE026 WHERE codigo_mov='$codigo_mov' and cod_presup='$cod_presup' and fuente_financ='$cod_fuente' and ref_imput_presu='$ref_imput_presu'";
  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO PRESUPUESTARIO NO EXISTE EN EL PAGO');</script> <?php }
   else{
     $resultado=pg_exec($conn,"SELECT ELIMINA_PRE026('$codigo_mov','$cod_presup','$cod_fuente','$ref_imput_presu')");
     $error=pg_errormessage($conn);     $error=substr($error, 0, 61);  if (!$resultado){?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
  }
}
pg_close($conn);
?>
<script language="JavaScript"> LlamarURL('<?php echo $url;?>'); </script>