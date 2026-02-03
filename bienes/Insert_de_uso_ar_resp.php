<?php include ("../class/conect.php");  include ("../class/funciones.php");
$ced_res_uso=$_POST["txtced_res_uso"]; 
$nombre_res_uso=$_POST["txtnombre_res_uso"]; 
$observaciones_uso=$_POST["textobservaciones_uso"]; echo "ESPERE POR FAVOR INCLUYENDO....","<br>"; $error=0;
$conn = pg_connect("host=".$host." port=5432 password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from BIEN031 WHERE ced_res_uso='$ced_res_uso'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('LA CEDULA YA EXISTE'); </script> <?php }
   else{ $error=1; $resultado=pg_exec($conn,"SELECT ACTUALIZA_BIEN031(1,'$ced_res_uso','$nombre_res_uso','$observaciones_uso')"); $error=pg_errormessage($conn);  $error=substr($error, 0, 61);
     if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }else{?><script language="JavaScript">muestra('INCLUYO EXITOSAMENTE');</script><?php  $error=0; }
  }
}
pg_close($conn); if ($error==0){?><script language="JavaScript">document.location ='Act_de_uso_ar_resp.php';</script> <?php } else {?>  <script language="JavaScript">history.back();</script> <?php }?>
