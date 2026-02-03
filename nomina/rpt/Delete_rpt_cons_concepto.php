<?php include ("../../class/conect.php");  include ("../../class/funciones.php");$fecha_hoy=asigna_fecha_hoy();
$cod_reporte=$_GET["codigo"]; $des_repote=""; $den_arch_rpt=""; $status="";
$equipo = getenv("COMPUTERNAME"); $minf_usuario=$usuario_sia." ".$equipo." ".date("d/m/y H:i a");echo "ESPERE POR FAVOR INCLUYENDO....","<br>"; $url="Det_rpt_cons_conceptos.php";
$conn = pg_connect("host=".$host." port=5432 password=".$password." user=".$user." dbname=".$dbname."");  $error=0;
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{ 
  if($error==0){if ($cod_reporte==''){$error=1; ?> <script language="JavaScript">muestra('CODIGO NO ES VALIDO');</script><?php } }  
  if($error==0){$sSQL="SELECT ACTUALIZA_NOM047(3,'$cod_reporte','$des_repote','$den_arch_rpt','$status')";
    $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR GRABANDO: ".substr($error, 0, 61); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }else{$error=0;?><script language="JavaScript">muestra('ELIMINO EXITOSAMENTE');</script><?php }
  }
}
pg_close($conn); if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>