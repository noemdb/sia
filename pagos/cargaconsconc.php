<?php  include ("../../class/conect.php"); include ("../../class/funciones.php");   
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");

$StrSQL="select * from nom047  order by cod_reporte";  $res=pg_query($StrSQL);
?><select name="txtnomb_rpt" id="txtnomb_rpt" onFocus="encender(this)" onBlur="apagar(this);">  <?php 
while($registro=pg_fetch_array($res)){$codigo=$registro["cod_reporte"];  $nombre=$registro["des_repote"]."  ";
?><option value="<?php  echo $codigo;?>"><?php  echo $nombre;?></option>
<?php }?></select><?php pg_close($conn);?>