<?php include ("../class/conect.php");  include ("../class/funciones.php");
$cod_bien=$_GET["codigo"];
$codigo_mov=$_GET["codigo_mov"];
print_r($cod_bien);
$url="Det_inc_bienes_semo_depreciacion.php?codigo_mov=".$codigo_mov;
echo "ESPERE POR FAVOR ELIMINANDO....","<br>";
$error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{
  $sSQL="Select * from BIEN050 WHERE codigo_mov='$codigo_mov' and cod_bien='$cod_bien'";
  $resultado=pg_exec($conn,$sSQL);
  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO BIEN NO EXISTE');</script> <?php }
   else{
     $resultado=pg_exec($conn,"SELECT ELIMINA_BIEN050('$codigo_mov','$cod_bien')");
     $error=pg_errormessage($conn);
     $error=substr($error,0,91);
     if (!$resultado){?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
  }
}
pg_close($conn);
?>
<script language="JavaScript"> LlamarURL('<?php echo $url;?>'); </script>
