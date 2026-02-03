<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_aplicacion=$_GET["Gaplicacion"];$den_aplicacion="";echo "ESPERE POR FAVOR ELIMINANDO....","<br>";$error=0;
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from PRE025 WHERE cod_aplicacion='$cod_aplicacion'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CÓDIGO DE APLICACIÒN NO EXISTE');  </script> <?php }
   else{ $resultado=pg_exec($conn,"SELECT ACTUALIZA_PRE025(3,'$cod_aplicacion','$den_aplicacion')");  $error=pg_errormessage($conn); $error=substr($error, 0, 61);
     if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php } else{$error= "ELIMINO EXITOSAMENTE"; ?><script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script>         <?php }
  }
}
pg_close($conn);if ($error==0){?><script language="JavaScript">document.location ='Act_tipo_aplica.php';</script> <?php }else {?>  <script language="JavaScript">history.back();</script> <?php }?>