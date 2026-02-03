<?php include ("../class/conect.php");  include ("../class/funciones.php"); 
$password=$_GET["password"]; $user=$_GET["user"]; $dbname=$_GET["dbname"]; $valor=$_GET["valor"]; $cant=0;
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
$StrSQL="select cod_tipo_en, tipo_en from BAN020 order by cod_tipo_en";  $res=pg_query($StrSQL);
?><select name="txttipo_en" id="txttipo_en" onFocus="encender(this)" onBlur="apagar(this)" ><?php 
while($registro=pg_fetch_array($res)){$tipo_en=$registro["tipo_en"]; $cant=$cant+1;
if($tipo_en==$valor){?><option value="<?php  echo $tipo_en;?>" selected><?php  echo $tipo_en;?></option>
<?php }else{?><option value="<?php  echo $tipo_en;?>"><?php  echo $tipo_en;?></option>
<?php } }?></select><?php pg_close($conn);?>