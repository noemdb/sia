<?php include ("../class/conect.php");  include ("../class/funciones.php"); $fecha_hoy=asigna_fecha_hoy();   $url="Act_tasa_inte_pres_ar.php";
$numero=$_POST["txtnumero"]; $fecha_desde=$_POST["txtfecha_desde"]; $fecha_hasta=$_POST["txtfecha_hasta"]; $tasa=$_POST["txttasa"]; $tasa=formato_numero($tasa); if(is_numeric($tasa)){$tasa=$tasa;}else{$tasa=0;}
$equipo = getenv("COMPUTERNAME"); $minf_usuario=$usuario_sia." ".$equipo." ".date("d/m/y H:i a");echo "ESPERE POR FAVOR INCLUYENDO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $error=0; $ahasta=$fecha_hasta; $sahasta=formato_aaaammdd($fecha_desde);
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{ $sSQL="Select tasa from NOM021 WHERE numero='$numero'"; $resultado=pg_query($sSQL); $filas=pg_num_rows($resultado);if($filas>=1){$error=1;?><script language="JavaScript"> muestra('NÚMERO DE GACETA YA EXISTE');</script><?php }
   if($error==0){if(checkData($fecha_desde)=='1'){$sfechad=formato_aaaammdd($fecha_desde);} else{$error=1;?><script language="JavaScript">muestra('FECHA DESDE NO ES VALIDA');</script><?php } }
   if($error==0){if(checkData($fecha_hasta)=='1'){$sfechah=formato_aaaammdd($fecha_hasta);} else{$error=1;?><script language="JavaScript">muestra('FECHA HASTA NO ES VALIDA');</script><?php } }
   if($error==0){if(strlen($numero)==6){$error=0;} else{$error=1; ?> <script language="JavaScript"> muestra('LONGITUD NUMERO DE GACETA INVALIDA');</script><?php } }
   if($error==0){$sSQL="select * from nom021 order by fecha_hasta desc"; $resultado=pg_query($sSQL); $filas=pg_num_rows($resultado);if($filas>=1){$registro=pg_fetch_array($resultado); $ahasta=$registro["fecha_hasta"];}
     if(($sfechad>$sfechah)or($sfechad<$sahasta)){$error=1;?><script language="JavaScript">muestra('FECHA DESDE NO ES VALIDA');</script><?php } }
   if($error==0){$sfecha=formato_aaaammdd($fecha_hoy); $sSQL="SELECT ACTUALIZA_NOM021(1,'$numero','$sfechad','$sfechah',$tasa)";
    $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR GRABANDO: ".substr($error, 0, 61); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }else{$error=0;?><script language="JavaScript">muestra('INCLUYO EXITOSAMENTE');</script><?php }
  }
}pg_close($conn); if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>