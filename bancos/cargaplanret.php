<?php include ("../class/conect.php");  include ("../class/funciones.php"); 
$codigo_mov=$_GET["codigo_mov"]; $password=$_GET["password"];$user=$_GET["user"]; $dbname=$_GET["dbname"]; $tipo=$_GET["tipo"]; $pdesde=$_GET["pdesde"]; $phasta=$_GET["phasta"];
$fdesde=$_GET["fdesde"];  $fhasta=$_GET["fhasta"]; $fdesde=formato_aaaammdd($fdesde);  $fhasta=formato_aaaammdd($fhasta);
?><iframe src="Det_ent_planillas.php?tipo_planilla=<?php echo $tipo?>&plan_desde=<?php echo $pdesde?>&plan_hasta=<?php echo $phasta?>&fecha_desde=<?php echo $fdesde?>&fecha_hasta=<?php echo $fhasta?>"  width="940" height="350" scrolling="auto" frameborder="1"> </iframe>
<?php pg_close($conn);?>