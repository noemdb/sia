<?php include ("../class/conect.php"); include ("../class/funciones.php"); $ciudad=$_GET["ciudad"];$cod_estado=$_GET["cod_estado"];
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
$StrSQL="select cod_ciudad,nombre_ciudad from PRE094 where substr(cod_ciudad,1,2)='".$cod_estado."' order by cod_ciudad";  $res=pg_query($StrSQL);
//echo $cod_estado.$StrSQL;
?><select class="Estilo10" name="txtciudad" id="txtciudad" onFocus="encender(this)" onBlur="apagar(this);">  <?php 
while($registro=pg_fetch_array($res)){$codigo=$registro["cod_ciudad"];  $nombre=$registro["nombre_ciudad"];
if($nombre==$ciudad){?><option value="<?php  echo $nombre;?>" selected><?php  echo $nombre;?></option>
<?php }else{?><option value="<?php  echo $nombre;?>"><?php  echo $nombre;?></option> <?php } }?></select><?php pg_close($conn);?>