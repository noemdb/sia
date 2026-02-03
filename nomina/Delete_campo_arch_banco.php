<?php include ("../class/conect.php");  include ("../class/funciones.php"); $fecha_hoy=asigna_fecha_hoy();   $error=0;
$cod_arch_banco=$_GET["cod_arch_banco"]; $tipo_arch_banco=$_GET["tipo_arch_banco"];  $pos_campo=$_GET["pos_campo"];
$equipo = getenv("COMPUTERNAME"); $minf_usuario=$usuario_sia." ".$equipo." ".date("d/m/y H:i a");echo "ESPERE POR FAVOR ELIMINANDO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $url="Det_inc_archivo_banco.php?criterio=".$tipo_arch_banco.$cod_arch_banco;
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{ $sSQL="Select cod_arch_banco from NOM052 WHERE cod_arch_banco='$cod_arch_banco' and tipo_arch_banco='$tipo_arch_banco' and pos_campo='$pos_campo'"; $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if($filas==0){$error=1; ?> <script language="JavaScript"> muestra('LINEA DE ARCHIVO NO EXISTE');</script><?php }
   if($error==0){$sSQL="SELECT ACTUALIZA_NOM052(3,'$cod_arch_banco','$tipo_arch_banco','$pos_campo','','',0,0,0,0,'N','N','N','N','N','N','N','N','N','N','N','N','N','N','')";
    $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR GRABANDO: ".substr($error, 0, 61); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }else{$error=0;?><script language="JavaScript">muestra('ELIMINO EXITOSAMENTE');</script><?php }
  }
}pg_close($conn);
if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>