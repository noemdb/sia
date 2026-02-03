<?php include ("../class/conect.php");  include ("../class/funciones.php");
$codigo=$_POST["txtcodigo"]; $tipo_situacion=$_POST["txttipo_situacion"]; $des_sit_contable=$_POST["txtdes_sit_contable"];echo "ESPERE POR FAVOR INCLUYENDO....","<br>"; $error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from BIEN010 WHERE codigo='$codigo'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO SITUACION CONTABLE YA EXISTE'); </script> <?php }
   else{ $error=1; $resultado=pg_exec($conn,"SELECT ACTUALIZA_BIEN010(1,'$codigo','$tipo_situacion','$des_sit_contable')"); $error=pg_errormessage($conn);  $error=substr($error, 0, 61);if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }else{?><script language="JavaScript">muestra('INCLUYO EXITOSAMENTE');</script><?php  $error=0; }
  }
}
pg_close($conn); if ($error==0){?><script language="JavaScript">document.location ='Act_situ_contable_bien_ar.php?Gcodigo=<?php echo $codigo;?>';</script> <?php } else {?>  <script language="JavaScript">history.back();</script> <?php }?>
