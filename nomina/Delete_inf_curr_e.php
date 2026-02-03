<?php include ("../class/conect.php");  include ("../class/funciones.php");error_reporting(E_ALL);$fecha=$_GET["fecha"];$codigo_mov=$_GET["codigo_mov"];
$url="Det_inc_inf_curricular_e.php?codigo_mov=".$codigo_mov;echo "ESPERE POR FAVOR ELIMINANDO....","<br>"; $error=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript">   muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{ $error=0;
  $sSQL="Select * from NOM067 WHERE codigo_mov='$codigo_mov' and fecha='$fecha'";
  $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('INFORMACION CURRICULAR NO EXISTE');</script><?php }
   else{$sSQL="SELECT ACTUALIZA_NOM067(3,'$codigo_mov','','$fecha','','','')";
      $resultado=pg_exec($conn,$sSQL); $error=pg_errormessage($conn); $error="ERROR ELIMINANDO: ".substr($error, 0, 61); if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }
  }
}
pg_close($conn); if($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script><?php }else{?><script language="JavaScript">history.back();</script><?php }?>
