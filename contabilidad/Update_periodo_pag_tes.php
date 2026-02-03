<?php include ("../class/conect.php");  include ("../class/funciones.php"); $periodo=$_POST["txtperiodo"]; $periodotes=$_POST["txtperiodotes"];
$equipo=getenv("COMPUTERNAME");$MInf_Usuario = $equipo." ".date("d/m/y H:i a"); echo "ESPERE POR FAVOR ACTUALIZANDO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname.""); $error=0;
if (pg_last_error($conn)) { ?> <script language="JavaScript"> muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script> <?php }
 else{ $error=0;
   $resultado=pg_exec($conn,"UPDATE SIA005 set campo503='$periodotes' where campo501='02'"); $error=pg_errormessage($conn); $error=substr($error,0,91); if(!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php } 
   $resultado=pg_exec($conn,"UPDATE SIA005 set campo503='$periodo' where campo501='01'"); $error=pg_errormessage($conn); $error=substr($error,0,91); if(!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php } 
 }
pg_close($conn); error_reporting(E_ALL ^ E_WARNING);
if($error==0){?><script language="JavaScript">document.location='menu.php';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>


