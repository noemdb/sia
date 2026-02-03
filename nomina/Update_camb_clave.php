<?php include ("../class/conect.php");  include ("../class/funciones.php");$login=$_POST["txtnombre_usuario"]; $claveA=$_POST["txtClaveA"]; $ClaveN=$_POST["txtClaveN"];   $ClaveNR=$_POST["txtClaveNR"]; $tclave=$ClaveN; $tclave=eliminar_car_claves($tclave); 
$equipo = getenv("COMPUTERNAME");$MInf_Usuario = $equipo." ".date("d/m/y H:i a"); echo "ESPERE POR FAVOR ACTUALIZANDO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname.""); $error=0;
if (pg_last_error($conn)) { ?> <script language="JavaScript"> muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script> <?php }
 else{$sSQL="Select campo101 from SIA001 WHERE campo101='$login' and campo102='$claveA'"; $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado); $sql="select busca_sia001('$login','$claveA');"; $res=pg_query($sql);$filas=pg_num_rows($res); if ($filas>=1){  $registro=pg_fetch_array($res);$filas=$registro[0]; }
  if($filas==0){$error=1;?> <script language="JavaScript"> muestra('USUARIO NO EXISTE'); </script><?php }
  if($error==0){ if($tclave==$ClaveN){ $error=0;}else{$error=1;  ?><script language="JavaScript"> muestra('CLAVE NO VALIDA'); </script> <?php } }
  if($error==0){ if($ClaveN<>$ClaveNR) {$error=1;?> <script language="JavaScript"> muestra('CLAVES NO SON IGUALES'); </script><?php }
     else{$resultado=pg_exec($conn,"SELECT cambio_sia001('$login','$ClaveN')"); $error=pg_errormessage($conn); $error=substr($error, 0, 61); if(!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php } else{?><script language="JavaScript">muestra('COMBIO CLAVE EXITOSAMENTE');</script><?php }
  }}
}pg_close($conn); error_reporting(E_ALL ^ E_WARNING);

if($error==0){?><script language="JavaScript">document.location='menu.php';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>


