<?php include ("../class/conect.php"); include ("../class/funciones.php"); $cod_concepto=$_GET["cod_concepto"]; $tipo_nomina=$_GET["tipo_nomina"];  $cod_retencion="000"; $frec="1";
$conn=pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname.""); $StrSQL="Select * from NOM002 WHERE tipo_nomina='$tipo_nomina' and cod_concepto='$cod_concepto'"; 
$resultado=pg_query($StrSQL);$filas=pg_num_rows($resultado);if($filas>0){$registro=pg_fetch_array($resultado); $cod_retencion=$registro["cod_retencion"]; $frec=$registro["frecuencia"];} pg_close($conn);?>
<select name="txtfrecuencia" size="1" id="txtfrecuencia" onFocus="encender(this)" onBlur="apagar(this)">
<?php if($frec=="1"){?><option selected>PRIMERA QUINCENA</option> <?php }else{?><option>PRIMERA QUINCENA</option><?php }?>
<?php if($frec=="2"){?><option selected>SEGUNDA QUINCENA</option> <?php }else{?><option>SEGUNDA QUINCENA</option><?php }?>
<?php if($frec=="3"){?><option selected>PRIMERA Y SEGUNDA QUINCENA</option> <?php }else{?><option>PRIMERA Y SEGUNDA QUINCENA</option><?php }?>
<?php if($frec=="4"){?><option selected>PRIMERA SEMANA</option> <?php }else{?><option>PRIMERA SEMANA</option><?php }?>
<?php if($frec=="5"){?><option selected>SEGUNDA SEMANA</option> <?php }else{?><option>SEGUNDA SEMANA</option><?php }?>
<?php if($frec=="6"){?><option selected>TERCERA SEMANA</option> <?php }else{?><option>TERCERA SEMANA</option><?php }?>
<?php if($frec=="7"){?><option selected>CUARTA SEMANA</option> <?php }else{?><option>CUARTA SEMANA</option><?php }?>
<?php if($frec=="8"){?><option selected>QUINTA SEMANA</option> <?php }else{?><option>CUARTA SEMANA</option><?php }?>
<?php if($frec=="9"){?><option selected>TODAS LAS SEMANAS</option> <?php }else{?><option>TODAS LAS SEMANAS</option><?php }?>
<?php if($frec=="0"){?><option selected>ULTIMA SEMANA</option> <?php }else{?><option>ULTIMA SEMANA</option><?php }?>