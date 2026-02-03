<?php include ("../../class/conect.php");  include ("../../class/funciones.php");$fecha_hoy=asigna_fecha_hoy();
$cod_empleado=$_GET["txtcod_empleado"]; $fecha_mov=$_GET["txtfecha_mov"]; $mov_nuevo="NO";


$equipo=getenv("COMPUTERNAME"); $mcod_m="FORMA".$usuario_sia.$equipo; $codigo_mov=substr($mcod_m,0,49);
$mov_nuevo=substr($mov_nuevo,0,1);
?>
<html>
<head>  <title>CARGAR FORMA FP020</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
<script language="JavaScript" type="text/JavaScript">
function Llamar_Inc_Calculo(mop){ 
   document.form3.submit(); 
}
</script>
</head>
<body>
<?php 
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname.""); if (pg_last_error($conn)) { echo "<p><b>Ocurrio un error conectando a la base de datos: .</b></p>"; exit; }else{ $Nom_Emp=busca_conf(); }

?>

<form name="form3" method="post" action="/sia/nomina/rpt/llama_mod_forma_fp020.php">
<table width="10">
  <tr>
     <td width="5"><input name="txtuser" type="hidden" id="txtuser" value="<?php echo $user?>" ></td>
     <td width="5"><input name="txtpassword" type="hidden" id="txtpassword" value="<?php echo $password?>" ></td>
     <td width="5"><input name="txtdbname" type="hidden" id="txtdbname" value="<?php echo $dbname?>" ></td>
	 <td width="5"><input name="txtport" type="hidden" id="txtport" value="<?php echo $port?>" ></td>	 
	 <td width="5"><input name="txthost" type="hidden" id="txthost" value="<?php echo $host?>" ></td>
     <td width="5"><input name="txtcodigo_mov" type="hidden" id="txtcodigo_mov" value="<?php echo $codigo_mov?>" ></td>	 
     <td width="5"><input name="txtcod_empleado" type="hidden" id="txtcod_empleado" value="<?php echo $cod_empleado?>" ></td>	 
	 <td width="5"><input name="txtfecha_mov_n" type="hidden" id="txtfecha_mov_n" value="<?php echo $fecha_mov?>" ></td>	 
  </tr>
</table>
</form>

</body>
</html>
<?php pg_close($conn);
/* */
?><script language="JavaScript">Llamar_Inc_Calculo('<?php echo $mov_nuevo?>');</script> 