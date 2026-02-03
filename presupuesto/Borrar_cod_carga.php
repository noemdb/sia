<?php include ("../class/conect.php"); include ("../class/funciones.php");
$codigo=$_GET["codigo"]; $cod_fuente=substr($codigo,1,2);$cod_categoria=substr($codigo,3,20);
$url="Carga_codigos.php?Gcodigo=".$codigo;echo "ESPERE POR FAVOR MODIFICANDO....","<br>";
$error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{   $resultado=pg_exec($conn,"SELECT BORRAR_PRE032('$cod_categoria','$cod_fuente')");
   $error=pg_errormessage($conn);   $error=substr($error, 0, 61);
   if (!$resultado){?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
}
pg_close($conn);
?>
<script language="JavaScript">LlamarURL('<?php echo $url;?>'); </script>