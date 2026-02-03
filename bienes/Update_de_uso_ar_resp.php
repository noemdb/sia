<?php include ("../class/conect.php");  include ("../class/funciones.php");
$ced_res_uso=$_POST["txtced_res_uso"]; $nombre_res_uso=$_POST["txtnombre_res_uso"]; $observaciones_uso=$_POST["txtobservaciones_uso"]; 
$url="Act_de_uso_ar_resp.php"; echo "ESPERE POR FAVOR MODIFICANDO....","<br>"; $error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from BIEN031 WHERE ced_res_uso='$ced_res_uso'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CEDULA DEL RESPONSABLE DE USO NO EXISTE');</script> <?php }
   else{$error=1;$resultado=pg_exec($conn,"SELECT ACTUALIZA_BIEN031(2,'$ced_res_uso','$nombre_res_uso','$observaciones_uso')");$error=pg_errormessage($conn); $error=substr($error,0,91);
     if (!$resultado){?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php } else{ ?> <script language="JavaScript"> muestra('MODIFICO EXITOSAMENTE'); </script><?php  $error=0; }
  }
}
pg_close($conn);?> <script language="JavaScript"> LlamarURL('<?php echo $url;?>'); </script>
