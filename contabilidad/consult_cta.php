<?php include ("../class/conect.php");  include ("../class/funciones.php");error_reporting(E_ALL);
$Codigo_Cuenta=$_POST["txtCodigo_Cuenta"];$error=0; $equipo=getenv("COMPUTERNAME"); echo "ESPERE POR FAVOR BUSCANDO....","<br>";
if ($error==0){
  $conn = pg_connect("host=localhost port=5432 password=".$password." user=".$user." dbname=".$dbname."");
  if (pg_last_error($conn)) {$error=1; ?> <script language="JavaScript"> muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
  
  $sSQL="Select codigo_cuenta from con001 WHERE codigo_cuenta='$Codigo_Cuenta'";$resultado=pg_exec($conn,$sSQL);$filas=pg_numrows($resultado);
  if ($filas==0){$error=1;?><script language="JavaScript">muestra('CODIGO DE CUENTA NO EXISTE NO EXISTE');</script><?php }   
}
pg_close($conn); error_reporting(E_ALL ^ E_WARNING); if ($error==0){?><script language="JavaScript">document.location ='Act_cuentas.php?Gcodigo_cuenta=<?php  echo $Codigo_Cuenta; ?>';</script> <?php }
else {?>  <script language="JavaScript">history.back();</script> <?php }  ?>