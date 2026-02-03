<?php include ("../class/conect.php"); include ("../class/funciones.php"); include ("../class/configura.inc"); echo "ESPERE ACTUALIZANDO MAESTRO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)){ ?> <script language="JavaScript">  muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script> <?php }
else{ $Nom_Emp=busca_conf();
 //$resultado=pg_exec($conn,"delete from ban029"); $error=pg_errormessage($conn); $error=substr($error, 0, 91);
 $resultado=pg_exec($conn,"SELECT INCIALIZA_TABLAS(11,1,1,'')"); $error=pg_errormessage($conn); $error=substr($error, 0, 61);if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
 echo "ESPERE ACTUALIZANDO LIBROS....","<br>";
 $resultado=pg_exec($conn,"SELECT ACTUALIZA_LIBRO()"); $error=pg_errormessage($conn); $error=substr($error, 0, 61);if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
 echo "ESPERE ACTUALIZANDO BANCOS....","<br>";
 $resultado=pg_exec($conn,"SELECT ACTUALIZA_BANCO()"); $error=pg_errormessage($conn); $error=substr($error, 0, 61);if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
 if($Cod_Emp=="71"){ 
   echo "ESPERE ACTUALIZANDO MOVIMIENTOS DOLARES....","<br>";
   $resultado=pg_exec($conn,"SELECT ACTUALIZA_LIBRO_DOLARES()"); $error=pg_errormessage($conn); $error=substr($error, 0, 61);if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
 } 
}
?> <script language="JavaScript">  muestra('PROCESO FINALIZADO'); </script> <?php 
pg_close($conn);?> <script language="JavaScript">cerrar_ventana();</script>