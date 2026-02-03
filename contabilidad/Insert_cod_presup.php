<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_presup=$_POST["txtcod_presup"];$cod_contab_asoc=$_POST["txtCodigo_Cuenta"];$equipo = getenv("COMPUTERNAME");
$MInf_Usuario = $equipo." ".date("d/m/y H:i a");echo "ESPERE POR FAVOR INCLUYENDO...."; $error=0;
$url="Act_asoc_activo_hacienda.php";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript"> muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script> <?php }
 else{$sSQL="Select * from con019 WHERE cod_presup='$cod_presup'";$resultado=pg_exec($conn,$sSQL);$filas=pg_numrows($resultado);
  if ($filas>0){$error=1;?> <script language="JavaScript"> muestra('CODIGO PRESUPUESTARIO YA EXISTE');  </script>  <?php }
  
  if($error==0){ $sSQL="Select * from pre001 WHERE cod_presup='$cod_presup'";
      $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
      if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO PRESUPUESTARIO NO EXISTE');</script><?php }
  }
  if($error==0){
     $sSQL="Select * from con001 WHERE codigo_cuenta='$cod_contab_asoc'";      $resultado=pg_query($sSQL);   $filas=pg_num_rows($resultado);
     if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO CONTABLE NO EXISTE');</script><?php }
      else{ $registro=pg_fetch_array($resultado);
        if ($registro["cargable"]=="N"){$error=1; ?> <script language="JavaScript"> muestra('CODIGO CONTABLE NO ES CARGABLE');</script><?php }
     }
  }	 
  if($error==0){$resultado=pg_exec($conn,"SELECT ACTUALIZA_CON019(1,'$cod_presup','$cod_contab_asoc','','',0,0,'$MInf_Usuario')");$error=pg_errormessage($conn);$error=substr($error,0,91);
     if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
      else{?><script language="JavaScript">muestra('INCLUYO EXITOSAMENTE');</script><?php }
  }
  
}
pg_close($conn);
if ($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script> <?php }
else {?>  <script language="JavaScript">history.back();</script> <?php } 
?>