<?php include ("../class/conect.php"); include ("../class/funciones.php");   if($_GET["tasa"]){$tasa=$_GET["tasa"];}else{$tasa=0;}
$conn=pg_connect("host=localhost port=5432 password=".$password." user=".$user." dbname=".$dbname.""); $StrSQL="select * from COMP023 order by monto_tasa";  $res=pg_query($StrSQL);
?><select name="txtimpuesto" id="txtimpuesto" onFocus="encender(this)" onBlur="apagar(this);">  <?php 
while($registro=pg_fetch_array($res)){$codigo=$registro["cod_tasa"];  $mtasa=$registro["monto_tasa"];  $mtasa=formato_monto($mtasa);
if($mtasa==$tasa){?><option value="<?php  echo $mtasa;?>" selected><?php  echo $mtasa;?></option>
<?php }else{?><option value="<?php  echo $mtasa;?>"><?php  echo $mtasa;?></option>
<?php } }?></select><?php pg_close($conn);?>