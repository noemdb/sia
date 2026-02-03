<?php include ("../class/conect.php");  include ("../class/funciones.php");
$codigo=$_POST["txtcodigo"]; $edo_bien=$_POST["txtedo_bien"]; $descripcion=$_POST["txtdescripcion"]; echo "ESPERE POR FAVOR INCLUYENDO....","<br>"; $error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from BIEN004 WHERE codigo='$codigo'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE ESTADO DE CONSERVACION YA EXISTE'); </script> <?php }
   else{ $error=1; $resultado=pg_exec($conn,"SELECT ACTUALIZA_BIEN004(1,'$codigo','$edo_bien','$descripcion')"); $error=pg_errormessage($conn);  $error=substr($error, 0, 61);
     if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }else{?><script language="JavaScript">muestra('INCLUYO EXITOSAMENTE');</script><?php  $error=0; }
  }
}
pg_close($conn); if ($error==0){?><script language="JavaScript">document.location ='Act_edo_conservacion_ar.php?Gcodigo=<?php echo $codigo;?>';</script> <?php } else {?>  <script language="JavaScript">history.back();</script> <?php }?>
