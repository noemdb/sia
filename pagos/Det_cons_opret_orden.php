<?php include ("../class/conect.php");  include ("../class/funciones.php");
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { echo "<p><b>Ocurrio un error conectando a la base de datos: .</b></p>"; exit; }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>SIA ORDENAMIENTO DE PAGO (Detalles Ordenes de Retencion Canceladas)</title>
<LINK
href="../class/sia.css" type=text/css
rel=stylesheet>
</head>
<body>
 <table width="904" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td>
<?php
if (!$_GET){$criterio='';$nro_orden='';}
 else{$criterio=$_GET["clave"];$nro_orden=substr($criterio,0,8);
}
$sql="SELECT * FROM OP_RET_CANC where nro_cheque_r='$nro_orden' order by nro_orden_ret,tipo_retencion";
$res=pg_query($sql);
?>
       <table width="1200"  border="1" cellspacing='0' cellpadding='0' align="left" id="ord_ret_canceladas">
         <tr height="20" class="Estilo5">
           <td width="80"  align="left" bgcolor="#99CCFF"><strong>Orden</strong></td>
           <td width="500" align="left" bgcolor="#99CCFF"><strong>Concepto</strong></td>
           <td width="100" align="right" bgcolor="#99CCFF"><strong>Monto</strong></td>
           <td width="30" align="left" bgcolor="#99CCFF"><strong>Tipo</strong></td>
           <td width="300" align="left" bgcolor="#99CCFF"><strong>Descripcion</strong></td>
           <td width="170" align="left" bgcolor="#99CCFF" ><strong>Codigo Cont.</strong></td>
         </tr>
         <?php  $total=0; $monto=0;
while($registro=pg_fetch_array($res)){
if($total==0){$monto=0;
$prev_orden = $registro["nro_orden_ret"];$prev_tipo = $registro["tipo_retencion"];
$prev_concepto = $registro["des_orden_ret"];$prev_des_ret = $registro["descripcion_ret"];
$prev_con_cont = $registro["cod_contable_ret"];}
if (($prev_orden!=$registro["nro_orden_ret"]) or ($prev_tipo!=$registro["tipo_retencion"])) {
$monto=formato_monto($monto);$prev_concepto=substr($prev_concepto,0,140);$prev_des_ret=substr($prev_des_ret,0,100);
?>
         <tr bgcolor='#FFFFFF' bordercolor='#000000' height="20" class="Estilo5" onMouseOver="this.style.backgroundColor='#CCCCCC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#FFFFFF'"o"];" >
           <td width="80" align="left"><?php  echo $prev_orden; ?></td>
           <td width="500" align="left"><?php  echo $prev_concepto; ?></td>
           <td width="100" align="right"><?php  echo $monto; ?></td>
           <td width="30" align="left"><?php  echo $prev_tipo; ?></td>
           <td width="300" align="left"><?php  echo $prev_des_ret; ?></td>
           <td width="170" align="left"><?php  echo $prev_con_cont; ?></td>
         </tr>
<?php 
$monto=0;
$prev_orden = $registro["nro_orden_ret"];$prev_tipo = $registro["tipo_retencion"];
$prev_concepto = $registro["des_orden_ret"]; $prev_des_ret = $registro["descripcion_ret"];
$prev_con_cont = $registro["cod_contable_ret"];}
$monto=$monto+$registro["monto_retencion"];$total=$total+$registro["monto_retencion"];}  $total=formato_monto($total);
if ($monto>0) {
$monto=formato_monto($monto);$prev_concepto=substr($prev_concepto,0,140);$prev_des_ret=substr($prev_des_ret,0,100);
?>
         <tr bgcolor='#FFFFFF' bordercolor='#000000' height="20" class="Estilo5" onMouseOver="this.style.backgroundColor='#CCCCCC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#FFFFFF'"o"];" >
           <td width="80" align="left"><?php  echo $prev_orden; ?></td>
           <td width="500" align="left"><?php  echo $prev_concepto; ?></td>
           <td width="100" align="right"><?php  echo $monto; ?></td>
           <td width="30" align="left"><?php  echo $prev_tipo; ?></td>
           <td width="300" align="left"><?php  echo $prev_des_ret; ?></td>
           <td width="170" align="left"><?php  echo $prev_con_cont; ?></td>
         </tr>
<?php }?>
       </table></td>
   </tr>
   <tr>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td><table width="800" border="0">
       <tr>
         <td width="500">&nbsp;</td>
         <td width="100"><span class="Estilo5">TOTAL PASIVOS :</span></td>
         <td width="160"><table width="151" border="1" cellspacing="0" cellpadding="0">
             <tr>
               <td align="right" class="Estilo5"><?php  echo $total; ?></td>
             </tr>
         </table></td>
       </tr>
     </table></td>
   </tr>
 </table>
 <p>&nbsp;</p>
</body>
</html>
<?php 
  pg_close($conn);
?>