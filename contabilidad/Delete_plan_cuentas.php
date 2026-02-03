<?php include ("../class/conect.php");  include ("../class/funciones.php");
$Codigo_Cuenta=$_GET["txtCodigo_Cuenta"];
$nombre_cuenta="";
$Clasificacion="";
$TSaldo="";
echo "ESPERE POR FAVOR ELIMINANDO....";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn))  { ?>  <script language="JavaScript">  muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script>  <?php }
 else{
  $sSQL="Select * from con098 WHERE codigo_cuenta='$Codigo_Cuenta'";
  $resultado=pg_exec($conn,$sSQL);
  $filas=pg_numrows($resultado);
  if ($filas==0){?> <script language="JavaScript"> muestra('C&Oacute;DIGO DE CUENTA NO EXISTE');  </script> <?php }
   else{
     $resultado=pg_exec($conn,"SELECT ACTUALIZA_CON098(3,'$Codigo_Cuenta','$nombre_cuenta','$TSaldo','$Clasificacion')");
     $error=pg_errormessage($conn);
     $error=substr($error, 0, 61);
     if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }
      else{$error= "ELIMINO EXITOSAMENTE"; ?><script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script>         <?php }
  }
}
pg_close($conn);
?>
<script language="JavaScript"> cerrar_ventana(); </script>