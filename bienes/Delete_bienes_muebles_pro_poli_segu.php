<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_bien_mue=$_GET["Gcod_bien_mue"];  $equipo = getenv("COMPUTERNAME"); $minf_usuario = $equipo." ".date("d/m/y H:i a");
echo "ESPERE POR FAVOR ELIMINANDO....","<br>"; $error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{$sSQL="SELECT * From BIEN022 where cod_bien_mue='$cod_bien_mue'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('LA POLIZA DEL BIEN MUEBLE NO EXISTE');</script> <?php }
    else{ $error=1; $resultado=pg_exec($conn,"SELECT elimina_bien022('$cod_bien_mue')"); 
$error=pg_errormessage($conn);  $error=substr($error,0,91);
     if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }else{?><script language="JavaScript">muestra('ELIMINO EXITOSAMENTE');</script><?php  $error=0; }
  }
}
pg_close($conn); if ($error==0){?><script language="JavaScript"> window.close();window.opener.location.reload(); </script> <?php }?>


