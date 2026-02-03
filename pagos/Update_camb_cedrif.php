<?php include ("../class/conect.php");  include ("../class/funciones.php"); $ced_rif=$_POST["txtced_rif"];$nombre=$_POST["txtnombre"];$nombre=$_POST["txtnombre"]; $ced_new=$_POST["txtced_new"]; 
$equipo = getenv("COMPUTERNAME"); $minf_usuario = $equipo." ".date("d/m/y H:i a"); $fecha=asigna_fecha_hoy(); echo "ESPERE POR FAVOR CAMBIANDO CEDULA/RIF....","<br>"; $error=0;
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{ $sSQL="Select * from PRE099 WHERE ced_rif='$ced_rif'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CEDULA/RIF DE BENEFICIARIO NO EXISTE'); </script> <?php }
   else{ $registro=pg_fetch_array($resultado,0); $nom_ant=$registro["nombre"]; $error=1;   if($fecha==""){$sfecha="2010-01-01";}else{$sfecha=formato_aaaammdd($fecha);}
     $sSQL="SELECT CAMBIA_CED_RIF('$ced_rif','$ced_new')"; $resultado=pg_exec($conn,$sSQL);$error=pg_errormessage($conn);$error=substr($error,0,91);   //echo $sSQL;
	 if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
      else{?><script language="JavaScript">muestra('MODIFICO EXITOSAMENTE');</script><?php  $error=0;	 $desc_doc="CAMBIO CEDULA/RIF ACTUAL:".$ced_rif.",  NOMBRE BENEFICIARIO:".$nom_ant." NUEVO:".$ced_new;
        $resultado=pg_exec($conn,"SELECT INCLUYE_SIA004('01','$usuario_sia','$usuario_sia','$equipo','Modifico','$sfecha','$desc_doc')"); $error=pg_errormessage($conn); $error=substr($error,0,91);if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php } }
  }
}
pg_close($conn);?><script language="JavaScript"> window.close(); window.opener.location.reload(); </script>