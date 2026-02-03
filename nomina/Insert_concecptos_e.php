<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_arch_banco=$_POST["txtcod_arch_banco"]; $cod_concepto=$_POST["txtcod_concepto"];  $url="Cat_conceptos_e.php?cod_arch_banco=".$cod_arch_banco."&cod_concepto=&denominacion=";
$equipo = getenv("COMPUTERNAME"); $MInf_Usuario=$equipo." ".date("d/m/y H:i a"); echo "ESPERE POR FAVOR INCLUYENDO....","<br>";  
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $error=0;
if (pg_last_error($conn)){$error=1; ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{
  if($cod_arch_banco==""){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE ARCHIVO NO VALIDO');</script><?php }	 
  if($error==0){$sSQL="Select * from NOM002 WHERE cod_concepto='$cod_concepto'"; $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
   if($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE CONCEPTO NO EXISTE');</script><?php }
  else{$registro=pg_fetch_array($resultado,0); $cod_concepto=$registro["cod_concepto"]; $denominacion=$registro["denominacion"]; } }
 if($error==0){ $sSQL="Select * from NOM061 WHERE cod_arch_banco='$cod_arch_banco' and cod_concepto='$cod_concepto'";
  $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if ($filas>=1){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE CONCEPTO YA EXISTE EN LA LISTA');</script><?php }
   else{$sSQL="SELECT ACTUALIZA_NOM061(1,'$cod_arch_banco','$cod_concepto','','','')";
     $resultado=pg_exec($conn,$sSQL); $merror=pg_errormessage($conn); $merror="ERROR GRABANDO: ".substr($merror, 0, 91); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $merror; ?>');</script><?php } }}
}    //echo $sSQL; 
pg_close($conn); 
if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>


