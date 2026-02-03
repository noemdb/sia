<?php include ("../class/conect.php");  include ("../class/funciones.php"); $fecha_hoy=asigna_fecha_hoy();   $error=0;
$tipo_informe=$_POST["txttipo_informe"]; $linea=$_POST["txtlinea"]; $monto=0; $calculo='N';
$codigo_cuenta=$_POST["txtCodigo_Cuenta"];    $nombre_cuenta=$_POST["txtNombre_Cuenta"]; 
$operacion=substr($_POST["txtoperacion"],0,1);  $status_c=substr($_POST["txtstatus_c"],0,1);
$equipo = getenv("COMPUTERNAME"); $minf_usuario=$usuario_sia." ".$equipo." ".date("d/m/y H:i a");echo "ESPERE POR FAVOR MODIFICANDO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $url="Det_inc_cal_informes.php?linea=".$linea."&cod_informe=".$tipo_informe;
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{ $sSQL="Select tipo_informe from CON007 WHERE tipo_informe='$tipo_informe' and linea='$linea' and codigo_cuenta='$codigo_cuenta'"; $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE CUENTA NO EXISTE EN EL CALCULO');</script><?php }
  if($error==0){ $sSQL="Select * from con001 WHERE codigo_cuenta='$codigo_cuenta'"; $resultado=pg_query($sSQL); $filas=pg_num_rows($resultado);
      if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE CUENTA NO EXISTE');</script><?php } } 
  if($error==0){$sSQL="SELECT ACTUALIZA_CON007(2,'$tipo_informe','$linea','$codigo_cuenta','$status_c','$operacion','$calculo',$monto)";
    $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR GRABANDO: ".substr($error,0,91); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }else{$error=0;?><script language="JavaScript">muestra('MODIFICO EXITOSAMENTE');</script><?php }
  }
}pg_close($conn);
if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>
