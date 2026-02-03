<?php include ("../class/conect.php");  include ("../class/funciones.php");  $fechad=$_GET["fecha"];$codigo_mov=$_GET["codigo_mov"]; $sueldo=0;
$equipo = getenv("COMPUTERNAME"); $MInf_Usuario=$equipo." ".date("d/m/y H:i a"); echo "ESPERE POR FAVOR ELIMINANDO....","<br>";
$url="Det_inc_exp_laboral_e.php?codigo_mov=".$codigo_mov;  $cod_empleado="";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $error=0;
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{
  $sSQL="Select * from NOM070 WHERE codigo_mov='$codigo_mov' and fecha_desde='$fechad'";
  $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('EXPERIENCIA LABORAL NO EXISTE');</script><?php }
   else{$sfechad=$fechad;
      $sSQL="SELECT ACTUALIZA_NOM070(3,'$codigo_mov','$cod_empleado','$sfechad','$sfechad','','','',$sueldo)";
      $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR ELIMINANDO: ".substr($error, 0, 61); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }
  }
}
pg_close($conn); if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>