<?php include ("../class/conect.php");  include ("../class/funciones.php");$cod_empleado=$_GET["txtcod_empleado"];  $fecha_hoy=asigna_fecha_hoy(); $sfechan=formato_aaaammdd($fecha_hoy);
$equipo = getenv("COMPUTERNAME"); $minf_usuario=$usuario_sia." ".$equipo." ".date("d/m/y H:i a"); echo "ESPERE POR FAVOR ELIMINANDO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $error=0;
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{$sSQL="Select cod_empleado,fecha_calculo from NOM030 WHERE cod_empleado='$cod_empleado' and (tipo_calculo='S')"; $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if($filas==0){$error=1; ?> <script language="JavaScript"> muestra('SALDO DE PRESTACIONES NO EXISTE');</script><?php }
   else{$registro=pg_fetch_array($resultado); $afechac=$registro["fecha_calculo"];     $sfecha=formato_aaaammdd($fecha_hoy);  $fecha_c=formato_ddmmaaaa($afechac);
     $sSQL="Select cod_empleado,fecha_calculo from NOM030 WHERE cod_empleado='$cod_empleado'"; $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);if($filas>1){$error=1; ?> <script language="JavaScript"> muestra('TRABAJADOR TIENE CALCULO DE PRESTACIONES');</script><?php } }
  if($error==0){ $sSQL="SELECT ACTUALIZA_NOM030(3,'$cod_empleado','$afechac','1','S',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)";
     $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR ELIMINANDO: ".substr($error,0,91); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }else{?><script language="JavaScript">  muestra('ELIMINO EXITOSAMENTE'); </script><?php 
     $desc_doc="SALDO DE PRESTACIONES, CODIGO TRABAJADOR:".$cod_empleado.", FECHA CALCULO:".$fecha_c; $resultado=pg_exec($conn,"SELECT INCLUYE_SIA004('04','$usuario_sia','$usuario_sia','$equipo','Elimino','$sfecha','$desc_doc')");
     $error=pg_errormessage($conn); $error=substr($error,0,91);  if (!$resultado){?><script language="JavaScript">muestra('<?php echo $error;?>');</script><?php } }
  }
}
pg_close($conn);  ?><script language="JavaScript"> window.close(); window.opener.location.reload(); </script> 