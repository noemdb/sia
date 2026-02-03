<?php include ("../class/conect.php");  include ("../class/funciones.php");include ("../class/configura.inc");error_reporting(E_ALL);
$codigo_mov=$_POST["txtcodigo_mov"];$cod_bien_mue=$_POST["txtcod_bien_mue"];$monto_c=$_POST["txtmonto"];
$fecha=asigna_fecha_hoy();$monto_c=formato_numero($monto_c);if(is_numeric($monto_c)){$monto=$monto_c;} else{$monto=0;}
$equipo = getenv("COMPUTERNAME");$MInf_Usuario = $equipo." ".date("d/m/y H:i a"); $url="Det_inc_bienes_desin.php?codigo_mov=".$codigo_mov;

echo "ESPERE POR FAVOR INCLUYENDO....","<br>";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");$error=0;
if (pg_last_error($conn)){ ?><script language="JavaScript">muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');</script><?php }
 else {
  $sSQL="Select * from BIEN050 WHERE codigo_mov='$codigo_mov' and cod_bien='$cod_bien_mue'";
  $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
  if ($filas>0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DEL BIEN YA EXISTE EN EL MOVIMIENTO');</script><?php }
  if($error==0){ $sSQL="Select * from BIEN015 WHERE cod_bien_mue='$cod_bien_mue'";  $resultado=pg_query($sSQL);  $filas=pg_num_rows($resultado);
      if ($filas==0){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DEL BIEN NO EXISTE');</script><?php }  
	    else{  $registro=pg_fetch_array($resultado); $desincorporado=$registro["desincorporado"];  $codigo_cuenta=$registro["cod_contablea"];
		       if($desincorporado=="S"){$error=1; ?> <script language="JavaScript"> muestra('CODIGO DEL BIEN ESTA DESINCORPORADO');</script><?php } }   }
  if($error==0){ $sfecha=formato_aaaammdd($fecha);
      $resultado=pg_exec($conn,"SELECT ACTUALIZA_BIEN050(1,'$codigo_mov','','$sfecha','$cod_bien_mue','','D','',1,$monto_c,'','$codigo_cuenta',0,0)");
      $error=pg_errormessage($conn);  $error="ERROR GRABANDO: ".substr($error, 0, 61);
      if (!$resultado){?><script language="JavaScript">muestra('<?php  echo $error; ?>');</script><?php }
    }
  }
pg_close($conn);
if ($error==0){?><script language="JavaScript">document.location ='<?php  echo $url; ?>';</script> <?php }
else {?>  <script language="JavaScript">history.back();</script> <?php } ?>

