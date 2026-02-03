<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_cuenta=$_POST["txtCodigo_Cuenta"];
$codigo_mov=$_POST["txtcodigo_mov"];
$debito_credito=$_POST["txtDeb_Cre"];
$descripcion_a="CAUSADO PRESUPUESTARIO";
$monto=formato_numero($_POST["txtmonto"]);
if(is_numeric($monto)){ $monto_asiento=$monto;} else{$monto_asiento=0;}
echo "ESPERE POR FAVOR MODIFICANDO....","<br>";
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?>  <script language="JavaScript">  muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script>  <?php }
 else{
  $sSQL="Select * from CON008 WHERE codigo_mov='$codigo_mov' and cod_cuenta='$cod_cuenta' and debito_credito='$debito_credito'";
  $resultado=pg_query($sSQL);
  $filas=pg_num_rows($resultado);
  if ($filas==0){?> <script language="JavaScript">  muestra('CÓDIGO DE CUENTA NO EXISTE'); </script>    <?php }
   else{
     $registro=pg_fetch_array($resultado);
     if ($registro["modificable"]=="N"){$error=1; ?> <script language="JavaScript"> muestra('CUENTA NO PUEDE SER MODIFICADA EN EL COMPROBANTE');</script><?php }
     else{
     $resultado=pg_exec($conn,"SELECT MODIFICA_CUENTA_CON008('$codigo_mov','$debito_credito','$cod_cuenta',$monto_asiento,'$descripcion_a')");
     $error=pg_errormessage($conn);
     $error=substr($error, 0, 61);
     if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
     }
  }
}
pg_close($conn);
?>
<script language="JavaScript">document.location ='Det_inc_comp_caus.php?codigo_mov=<?php echo $codigo_mov?>';</script>