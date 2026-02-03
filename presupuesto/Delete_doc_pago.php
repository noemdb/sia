<?php include ("../class/conect.php");  include ("../class/funciones.php");
$Doc_pago=$_GET["txtdoc_pago"];$Nombre_doc_pago="";$Nombre_Abrev="";$Doc_pagoA="";
echo "ESPERE POR FAVOR ELIMINANDO....","<br>";
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?> <script language="JavaScript"> muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS');  </script> <?php }
 else{  $sSQL="Select * from pre004 WHERE tipo_pago='$Doc_pago'";  $resultado=pg_exec($conn,$sSQL);  $filas=pg_numrows($resultado);
  if ($filas==0){?> <script language="JavaScript">  muestra('DOCUMENTO PAGO NO EXISTE');  </script>  <?php }
   else{
     $resultado=pg_exec($conn,"SELECT ACTUALIZA_PRE004(3,'$Doc_pago','','','','','')");     $error=pg_errormessage($conn);     $error=substr($error, 0, 61);
     if (!$resultado){?>  <script language="JavaScript">  muestra('<?php  echo $error; ?>');  </script>  <?php }
      else{     $Doc_pagoA="A".substr($Doc_pago,1,3);
        $resultado=pg_exec($conn,"SELECT ACTUALIZA_PRE004(3,'$Doc_pagoA','','','','','')");   $error=pg_errormessage($conn);        $error=substr($error, 0, 61);
        if (!$resultado){ ?> <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }      else{?> <script language="JavaScript">  muestra('ELIMINO EXITOSAMENTE'); </script>      <?php }
        }
  }
}
pg_close($conn);if ($error==0){?><script language="JavaScript">document.location ='Act_doc_pago.php';</script> <?php }else {?>  <script language="JavaScript">history.back();</script> <?php }?>