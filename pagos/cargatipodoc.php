<?php include ("../class/conect.php");  include ("../class/funciones.php");  
$password=$_GET["password"]; $user=$_GET["user"]; $dbname=$_GET["dbname"]; if($_GET["tipo_doc"]){$tipo_doc=$_GET["tipo_doc"];}else{$tipo_doc="";}
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
$StrSQL="select * from PAG017 order by cod_documento";  $res=pg_query($StrSQL);
?><select name="txttipo_documento" size="1" id="txttipo_documento" onFocus="encender(this)" onBlur="apaga_tipodoc(this);" onchange="checktipodoc(this.form);" onkeypress="return stabular(event,this)"><?php 
while($registro=pg_fetch_array($res)){$codigo=$registro["tipo_documento"]; 
if($codigo==$tipo_doc){?><option value="<?php  echo $codigo;?>" selected><?php  echo $codigo;?></option>
<?php }else{?><option value="<?php  echo $codigo;?>"><?php  echo $codigo;?></option>
<?php } }?></select><?php pg_close($conn);?>