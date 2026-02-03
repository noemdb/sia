<?php include ("../class/conect.php");  include ("../class/funciones.php");  error_reporting(E_ALL);
$codigo_mov=$_POST["txtcodigo_mov"];$referencia_aju=$_POST["txtreferencia_aju"];$tipo_aju=$_POST["txttipo_ajuste"];
$nro_orden=$_POST["txtnro_orden"];$tipo_causado=$_POST["txttipo_causado"];$fecha=$_POST["txtfecha"];
$concepto=$_POST["txtconcepto"];$equipo = getenv("COMPUTERNAME");$MInf_Usuario = $equipo." ".date("d/m/y H:i a");
echo "ESPERE POR FAVOR MODIFICANDO....","<br>";
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)){ ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else{$error=0; $sql="Select nro_orden from PAG019 WHERE referencia_aju_ord='$referencia_aju'";
    $resultado=pg_exec($conn,$sql);  $filas=pg_numrows($resultado);
    if ($filas==0){$error=1;?><script language="JavaScript">muestra('REFERENCIA AJUSTE DE ORDEN NO EXISTE');</script><?php }
     else { $reg=pg_fetch_array($resultado);  $sfecha=formato_aaaammdd($fecha);
      $sSQL="SELECT MODIFICA_PAG019('$codigo_mov','$referencia_aju','$tipo_aju','$sfecha','$concepto')";
      $resultado=pg_exec($conn,$sSQL);  $error=pg_errormessage($conn);  $error=substr($error, 0, 61);
      if (!$resultado){?><script language="JavaScript"> muestra('<?php  echo $error; ?>');</script><?php  $error=1;}
        else{ $error=0;?><script language="JavaScript">  muestra('MODIFICO EXITOSAMENTE');</script><?php }
    }
 }
pg_close($conn);  echo $error;  error_reporting(E_ALL ^ E_WARNING);
if ($error==0){?><script language="JavaScript">document.location ='Act_ajuste_orden.php?Gcriterio=C<?php  echo $referencia_aju.$tipo_aju; ?>';</script> <?php }
else { ?> <script language="JavaScript"> alert('Error Modificando'); history.back(); </script>  <?php }?>