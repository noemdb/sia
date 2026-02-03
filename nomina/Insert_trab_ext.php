<?php include ("../class/conect.php");  include ("../class/funciones.php");
$codigo_mov=$_POST["txtcodigo_mov"]; $cod_empleado=$_POST["txtcod_empleado"];  $url="Det_trab_nom_ext.php?codigo_mov=".$codigo_mov;
$equipo = getenv("COMPUTERNAME"); $MInf_Usuario=$equipo." ".date("d/m/y H:i a"); echo "ESPERE POR FAVOR INCLUYENDO....","<br>";  
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $error=0;
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{$sql="SELECT cod_empleado,tipo_nomina,nombre,cedula,fecha_ingreso,cod_categoria,nacionalidad,status FROM NOM006 Where cod_empleado='$cod_empleado'"; $resultado=pg_query($sql);  $filas=pg_num_rows($resultado); if($filas==0){$error=1;?> <script language="JavaScript"> muestra('CODIGO DE TRABAJADOR NO EXISTE');</script><?php }
  else{$registro=pg_fetch_array($resultado); $tipo_nomina=$registro["tipo_nomina"]; $nombre=$registro["nombre"];   
  $cedula=$registro["cedula"]; $fecha_ingreso=$registro["fecha_ingreso"];  $nacionalidad=$registro["nacionalidad"]; $status=$registro["status"];}  
 if($error==0){ $sSQL="Select * from NOM072 WHERE codigo_mov='$codigo_mov' and cod_empleado='$cod_empleado'";
  $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if ($filas>=1){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE TRABAJADOR YA EXISTE EN EL CALCULO');</script><?php }
   else{$sSQL="SELECT ACTUALIZA_NOM072(1,'$codigo_mov','$cod_empleado','$cedula','$nombre','$tipo_nomina','$nacionalidad','$status','$fecha_ingreso')";
     $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR GRABANDO: ".substr($error, 0, 61); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php } }}
}  echo $sSQL; pg_close($conn); 
if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>
