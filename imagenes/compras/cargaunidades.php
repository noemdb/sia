<?php  include ("../class/conect.php"); include ("../class/funciones.php");   if($_GET["unidad"]){$unidad=$_GET["unidad"];}else{$unidad="UNIDAD";}
$conn=pg_connect("host=localhost port=5432 password=".$password." user=".$user." dbname=".$dbname.""); 
$StrSQL="select * from comp024 order by des_unidad_medida";  $res=pg_query($StrSQL);
?><select name="txtunidad_medida" id="txtunidad_medida" onFocus="encender(this)" onBlur="apagar(this);">  <?php 
while($registro=pg_fetch_array($res)){$codigo=$registro["cod_unidad_medida"];  $nombre=$registro["des_unidad_medida"];
if($nombre==$unidad){?><option value="<?php  echo $nombre;?>" selected><?php  echo $nombre;?></option>
<?php }else{?><option value="<?php  echo $nombre;?>"><?php  echo $nombre;?></option>
<?php } }?></select><?php pg_close($conn);?>