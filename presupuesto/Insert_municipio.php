<?php include ("../class/conect.php");  include ("../class/funciones.php");
$codigo=$_POST["txtCodigo_Municipio"]; $nombre=$_POST["txtNombre_Municipio"]; echo "ESPERE POR FAVOR INCLUYENDO....","<br>"; $error=0;
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from PRE093 WHERE cod_municipio='$codigo'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('CÓDIGO DEL MUNICIPIO YA EXISTE'); </script> <?php }
   else{ $error=1; $resultado=pg_exec($conn,"SELECT ACTUALIZA_PRE093(1,'$codigo','$nombre')"); $error=pg_errormessage($conn);  $error=substr($error, 0, 61);
     if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }else{?><script language="JavaScript">muestra('INCLUYO EXITOSAMENTE');</script><?php  $error=0; }
  }
}
pg_close($conn); if ($error==0){?><script language="JavaScript">document.location ='Act_municipios.php';</script> <?php } else {?>  <script language="JavaScript">history.back();</script> <?php }?>