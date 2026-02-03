<?php include ("../class/conect.php"); include ("../class/funciones.php"); $parroquia=$_GET["parroquia"];$cod_muni=$_GET["cod_muni"];
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");  $cod_muni=substr($cod_muni,0,4);
$StrSQL="select * from PRE096 where substr(cod_parroquia,1,4)='".$cod_muni."'  order by cod_parroquia";  $res=pg_query($StrSQL);  
?><select  class="Estilo10" name="txtparroquia" id="txtparroquia" onFocus="encender(this)" onBlur="apagar(this);">  <?php 
while($registro=pg_fetch_array($res)){$codigo=$registro["cod_parroquia"];  $nombre=$registro["nombre_parroquia"];
if($nombre==$parroquia){?><option value="<?php  echo $codigo;?>" selected><?php  echo $nombre;?></option>
<?php }else{?><option value="<?php  echo $codigo;?>"><?php  echo $nombre;?></option> <?php } }?></select><?php pg_close($conn);?>