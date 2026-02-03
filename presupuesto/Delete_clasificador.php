<?php include ("../class/conect.php");  include ("../class/funciones.php"); $cod_partida=$_GET["Gpartida"];$den_partida="";$func_inv="";$aplicacion="";$cod_contable="";$ord_cord="O";
echo "ESPERE POR FAVOR ELIMINANDO....","<br>";$error=0;
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{ $sSQL="Select * from PRE098 WHERE cod_partida='$cod_partida'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DE PARTIDA NO EXISTE');  </script> <?php }
   else{ $resultado=pg_exec($conn,"SELECT ACTUALIZA_PRE098(3,'$cod_partida','$den_partida','$aplicacion','$ord_cord','$func_inv','$cod_contable')");
     $error=pg_errormessage($conn);   $error=substr($error,0,91);   if (!$resultado){ ?> <script language="JavaScript">  muestra('<?php  echo $error; ?>'); </script> <?php }      else{$error= "ELIMINO EXITOSAMENTE"; ?><script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script>         <?php }
  }
}
pg_close($conn);if ($error==0){?><script language="JavaScript">document.location ='Act_clasificador.php';</script> <?php }else {?>  <script language="JavaScript">history.back();</script> <?php }?>