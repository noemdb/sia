<?php include ("../class/conect.php");  include ("../class/funciones.php");
$Doc_ajuste=$_POST["txtdoc_ajuste"];$Nombre_doc_ajuste=$_POST["txtnombre_doc_ajuste"];$Nombre_Abrev=$_POST["txtnombre_abrev"];
$Refiera_a=$_POST["txtRefierea"];$Doc_ajusteA="";$Nombre_doc_ajusteA="";
$equipo = getenv("COMPUTERNAME");$MInf_Usuario = $equipo." ".date("d/m/y H:i a");
echo "ESPERE POR FAVOR INCLUYENDO....","<br>";$error=0;
$conn = pg_connect("host=".$host." port=".$port." password=".$password." user=".$user." dbname=".$dbname."");
if (pg_last_error($conn)) { ?>  <script language="JavaScript"> muestra('OCURRIO UN ERROR CONECTANDO LA BASE DE DATOS'); </script> <?php }
 else{  $sSQL="Select * from pre005 WHERE tipo_ajuste='$Doc_ajuste'";
  $resultado=pg_exec($conn,$sSQL); $filas=pg_numrows($resultado);
  if ($filas>0){ $error=1; ?>  <script language="JavaScript">  muestra('DOCUMENTO COMPROMISO YA EXISTE');  </script> <?php }
   else{     $resultado=pg_exec($conn,"SELECT ACTUALIZA_PRE005(1,'$Doc_ajuste','$Nombre_doc_ajuste','$Nombre_Abrev','$Refiera_a','$MInf_Usuario')");
     $error=pg_errormessage($conn);   $error=substr($error, 0, 61);
     if (!$resultado){  ?>  <script language="JavaScript"> muestra('<?php  echo $error; ?>'); </script> <?php }
      else{$Doc_ajusteA="A".substr($Doc_ajuste,1,3);        $Nombre_doc_ajusteA = $Nombre_doc_ajuste." (ANULADO)";
        $resultado=pg_exec($conn,"SELECT ACTUALIZA_PRE005(1,'$Doc_ajusteA','$Nombre_doc_ajusteA','ANU','$Refiera_a','$MInf_Usuario')");
        $error=pg_errormessage($conn);        $error=substr($error, 0, 61);
        if (!$resultado){?> <script language="JavaScript">  muestra('<?php  echo $error; ?>');  </script> <?php }
         else{$error=0; ?> <script language="JavaScript">  muestra('INCLUYO EXITOSAMENTE');  </script> <?php }
        }
  }
}
pg_close($conn);if ($error==0){?><script language="JavaScript">document.location ='Act_doc_ajuste.php';</script> <?php }else {?>  <script language="JavaScript">history.back();</script> <?php }?>