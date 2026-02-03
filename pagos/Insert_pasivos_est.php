<?php include ("../class/conect.php");  include ("../class/funciones.php"); 
$codigo_cuenta=$_POST["txtCodigo_Cuenta"];$nombre_cuenta=$_POST["txtNombre_Cuenta"];
$codigo_mov=$_POST["txtcodigo_mov"];$debito_credito=$_POST["txtDeb_Cre"]; $descripcion_a="";
$monto=formato_numero($_POST["txtmonto"]); if(is_numeric($monto)){ $monto_asiento=$monto;} else{$monto_asiento=0;}
$equipo = getenv("COMPUTERNAME"); $MInf_Usuario = $equipo." ".date("d/m/y H:i a");
echo "ESPERE POR FAVOR INCLUYENDO....","<br>"; $url="Det_inc_pas_est.php?codigo_mov=".$codigo_mov;
$conn = pg_connect("host=localhost port=5432 password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)){ ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
   else{  $error=0; $sSQL="Select * from con001 WHERE codigo_cuenta='$codigo_cuenta'";  $resultado=pg_query($sSQL); $filas=pg_num_rows($resultado);
      if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CÓDIGO DE CUENTA NO EXISTE');</script><?php }
      else{$registro=pg_fetch_array($resultado);if ($registro["cargable"]=="N"){$error=1; ?> <script language="JavaScript"> muestra('CÓDIGO DE CUENTA NO ES CARGABLE');</script><?php } }
      if($monto_asiento==0){$error=1; ?> <script language="JavaScript"> muestra('MONTO NO PUEDE SER CERO');</script><?php }
      if ($error==0){ $sSQL="SELECT cod_banco,nombre_banco,nro_cuenta,cod_contable FROM ban002 WHERE cod_contable='$codigo_cuenta'";  $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
       if ($filas>0){ $error=1;?> <script language="JavaScript">muestra('CÓDIGO DE CUENTA ASOCIADA A UN BANCO');</script> <?php } }
      if ($error==0){ $sSQL="Select * from PAG030 WHERE codigo_mov='$codigo_mov' and cod_cuenta='$codigo_cuenta' and debito_credito='$debito_credito'";   $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
         if ($filas>0){ $error=1;?> <script language="JavaScript">muestra('CÓDIGO DE CUENTA YA EXISTE EN OTRSO PASIVOS');</script> <?php }
      }
      if ($error==0){$resultado=pg_exec($conn,"SELECT ACTUALIZA_PAG030 ('1','$codigo_mov','$codigo_cuenta','$debito_credito','$monto_asiento')");
         $error=pg_errormessage($conn);  $error="ERROR GRABANDO: ".substr($error, 0, 61); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php } }
}
pg_close($conn); if ($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script> <?php } else {?>  <script language="JavaScript">history.back();</script> <?php } ?>