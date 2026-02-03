<?php include ("../class/conect.php"); include ("../class/funciones.php"); echo "ESPERE ACTUALIZANDO MOVIMIENTOS....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)){ ?> <script language="JavaScript">  muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script> <?php }
 else{
  $resultado=pg_exec($conn,"SELECT ACTUALIZA_MOVIMIENTOS(0)"); $error=pg_errormessage($conn); $error=substr($error, 0, 90);
  if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
  echo "ESPERE ACTUALIZANDO AJUSTES....","<br>";
  $resultado=pg_exec($conn,"SELECT ACTUALIZA_MOVIMIENTOS(3)");  $error=pg_errormessage($conn);  $error=substr($error, 0, 90);
  if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
  echo "ESPERE ACTUALIZANDO CAUSADOS....","<br>";
  $resultado=pg_exec($conn,"SELECT ACTUALIZA_MOVIMIENTOS(1)");  $error=pg_errormessage($conn);  $error=substr($error, 0, 90);
  if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
  echo "ESPERE ACTUALIZANDO PAGOS....","<br>";
  $resultado=pg_exec($conn,"SELECT ACTUALIZA_MOVIMIENTOS(2)");  $error=pg_errormessage($conn);  $error=substr($error, 0, 90);
  if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
  echo "ESPERE ACTUALIZANDO DIFERIDOS....","<br>";
  $resultado=pg_exec($conn,"SELECT ACTUALIZA_MOVIMIENTOS(4)");  $error=pg_errormessage($conn);  $error=substr($error, 0, 90);
  if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
  ?> <script language="JavaScript">  muestra('PROCESO FINALIZADO'); </script> <?php 
}pg_close($conn);?>
<script language="JavaScript">javascript:window.close();</script>