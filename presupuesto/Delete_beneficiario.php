<?php include ("../class/conect.php");  include ("../class/funciones.php");
$ced_rif=$_GET["Gced_rif"];  $equipo = getenv("COMPUTERNAME"); $minf_usuario = $equipo." ".date("d/m/y H:i a");
$fecha=asigna_fecha_hoy(); echo "ESPERE POR FAVOR ELIMINANDO....","<br>"; $error=0;
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from PRE099 WHERE ced_rif='$ced_rif'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CEDULA/RIF DE BENEFICIARIO NO EXISTE'); </script> <?php }
   else{    $registro=pg_fetch_array($resultado,0); $nom_ant=$registro["nombre"]; 
    $sSQL = "SELECT cod_presup FROM PRE006 WHERE (ced_rif='$ced_rif')";    $resultado=pg_exec($conn,$sSQL);    $filas=pg_numrows($resultado);
    if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('BENEFICIARIO TIENE COMPROMISOS, NO PUEDE SER ELIMINADO');</script><?php }
    $sSQL = "SELECT cod_presup FROM PAG001 WHERE (ced_rif='$ced_rif')";    $resultado=pg_exec($conn,$sSQL);    $filas=pg_numrows($resultado);
    if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('BENEFICIARIO TIENE ORDENES DE PAGO, NO PUEDE SER ELIMINADO');</script><?php }	
	$sSQL = "SELECT cod_presup FROM BAN006 WHERE (ced_rif='$ced_rif')";    $resultado=pg_exec($conn,$sSQL);    $filas=pg_numrows($resultado);
    if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('BENEFICIARIO TIENE CHEQUES, NO PUEDE SER ELIMINADO');</script><?php }	
	$sSQL = "SELECT cod_presup FROM BAN012 WHERE (ced_rif='$ced_rif')";    $resultado=pg_exec($conn,$sSQL);    $filas=pg_numrows($resultado);
    if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('BENEFICIARIO TIENE PLANILLA DE RETENCION, NO PUEDE SER ELIMINADO');</script><?php }	
	$sSQL = "SELECT cod_presup FROM BAN027 WHERE (ced_rif='$ced_rif')";    $resultado=pg_exec($conn,$sSQL);    $filas=pg_numrows($resultado);
    if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('BENEFICIARIO TIENE PLANILLA DE RETENCION IVA, NO PUEDE SER ELIMINADO');</script><?php }	
   }
  if($error==0){ $error=1;  if($fecha==""){$sfecha="2007-01-01";}else{$sfecha=formato_aaaammdd($fecha);}
     $sSQL="SELECT ACTUALIZA_PRE099(3,'$ced_rif','','','','','','','','','','','','','','','','','','','','','','','','','$sfecha','','','','','','',0,0,'$minf_usuario')";
     $resultado=pg_exec($conn,$sSQL);  $error=pg_errormessage($conn);  $error=substr($error, 0, 61);
     if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
      else{?><script language="JavaScript">muestra('ELIMINO EXITOSAMENTE');</script><?php  $error=0;  $desc_doc="CEDULA/RIF:".$ced_rif.",  NOMBRE BENEFICIARIO:".$nom_ant;
        $resultado=pg_exec($conn,"SELECT INCLUYE_SIA004('05','$usuario_sia','$usuario_sia','$equipo','Elimino','$sfecha','$desc_doc')"); $error=pg_errormessage($conn);   $error=substr($error, 0, 61);
        if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php } }
  }
}
pg_close($conn);
?> <script language="JavaScript"> cerrar_ventana(); </script>