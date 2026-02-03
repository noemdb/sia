<?php include ("../class/conect.php");  include ("../class/funciones.php"); 
error_reporting(E_ALL);$mes_libro=$_GET["txtmes_libro"];
echo "ESPERE POR FAVOR ELIMINANDO....","<br>"; $error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{ $sql="Select mes_libro from PAG032 where mes_libro='$mes_libro'";  $resultado=pg_query($sql);  $filas=pg_num_rows($resultado);
   if ($filas==0){$error=1; echo $sql; ?> <script language="JavaScript"> muestra('MES LIBRO DE COMPAS NO EXISTE');</script><?php }
    else{$sSQL="SELECT BORRAR_PAG032('$mes_libro')";  $resultado=pg_exec($conn,$sSQL);  $error=pg_errormessage($conn);  $error="ERROR ELIMINANDO: ".substr($error, 0, 61);
    if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php } else{?><script language="JavaScript">muestra('ELIMINO EXITOSAMENTE');</script><?php }
    }
}
pg_close($conn);  error_reporting(E_ALL ^ E_WARNING);?><script language="JavaScript">  window.close(); window.opener.location.reload(); </script>