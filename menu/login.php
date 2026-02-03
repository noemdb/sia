<?php include 'vars.php'; ?>

<!-- <!DOCTYPE html> -->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<LINK REL="SHORTCUT ICON" HREF="../imagenes/sia.ico">

<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <SCRIPT language="JavaScript" src="../class/sia.js" type="text/javascript"></SCRIPT>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Menu para la aplicacion SIPAP 6.0">
  <meta name="author" content="@noemdb: Desarrollador Senior Laravel">
  <title>Ingreso de Usuario SIPAP 6.0</title>

  <!-- Modern UI Styles -->
  <link href="./css/modern.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="./vendor/fontawesome/5.2.0/css/all.css" rel="stylesheet">

  <SCRIPT language="JavaScript" src="../class/revisar.js" type="text/javascript"></SCRIPT>

</head>

<body class="text-center">

  <form class="form-signin pb-0" name="form1" action="../<?php echo $main_url; ?>/control.php" method="post"
    onSubmit="return revisar()">

    <!-- 
    <a href="menu.html">
    <img class="" src="./login_files/bootstrap-solid.svg" alt="" width="72" height="72">
    </a>
    -->

    <h4 class="masthead-brand">
      <hr class="color1">
      <hr class="color2">

      <table>
        <tr>
          <td class="text-left font-weight-bold" width="75%">
            <?php echo $main_title; ?>
          </td>
          <td class="text-right" width="25%">
            <i class="<?php echo $main_icon ?> fa-2x text-<?php echo $main_color ?>"></i>
          </td>
        </tr>
      </table>

      <hr class="color3">
      <hr class="color4">
    </h4>

    <!-- <h1 class="h5 font-weight-bold">Datos de acceso</h1> -->

    <!-- <div align="left"><small class="font-weight-bold text-muted">Datos de Acceso</small></div> -->

    <label for="inputKbrand" class="sr-only">Clave de la Epresa</label>
    <input name="txtempresa" value="DATOS" type="input" id="inputKbrand" class="form-control"
      placeholder="Clave de Empresa" required autofocus>

    <label for="inputUser" class="sr-only">Nombre de Usuario</label>
    <input name="txtusuario" type="input" id="inputUser" class="form-control" placeholder="Nombre de Usuario" required>

    <label for="inputPassword" class="sr-only">Contraseña</label>
    <input name="txtclave" type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>

    <button class="btn btn-lg btn-primary btn-block pb-2 mb-2" type="submit">Ingresar</button>

    <div class="btn-group btn-block mb-2" role="group" aria-label="Basic example">

      <?php foreach ($arr_module as $k => $v): ?>

        <a href="<?php echo $url . $k ?>" title="<?php echo $v['nom_module'] ?>"
          class="btn btn-<?php echo $v['color'] ?> btn-sm <?php echo ($k == $_GET['module']) ? " active " : ""; ?>">
          <i class="<?php echo $v['icon'] ?>"></i>
        </a>

      <?php endforeach ?>

      <a href="<?php echo $urlhome ?>" title="Inicio" class="btn btn-primary btn-bg">
        <i class="fas fa-home"></i>
      </a>

    </div>

    <div class="alert alert-light" role="alert">
      <svg height="30" width="30">
        <rect x="5" y="5" rx="5" ry="5" width="20" height="20" class="box1" />
      </svg>
      <svg height="30" width="30">
        <rect x="5" y="5" rx="5" ry="5" width="20" height="20" class="box2" />
      </svg>
      <svg height="30" width="30">
        <rect x="5" y="5" rx="5" ry="5" width="20" height="20" class="box3" />
      </svg>
      <svg height="30" width="30">
        <rect x="5" y="5" rx="5" ry="5" width="20" height="20" class="box4" />
      </svg>

      <svg height="30" width="30">
        <rect x="5" y="5" rx="5" ry="5" width="20" height="20" class="box5" />
      </svg>
      <svg height="30" width="30">
        <rect x="5" y="5" rx="5" ry="5" width="20" height="20" class="box6" />
      </svg>

      <svg height="30" width="30">
        <rect x="5" y="5" rx="5" ry="5" width="20" height="20" class="box7" />
      </svg>

    </div>

    <footer class="mastfoot mt-auto pt-2" style="opacity: 0.4;">
      <div class="inner">
        <small class="text-muted">
          <p>Basado en <a href="https://getbootstrap.com/">Bootstrap</a> Desarrollado por: <a
              href="https://twitter.com/noemdb">@noemdb</a></p>
        </small>
      </div>
    </footer>

  </form>

  <?php if ($_GET) {
    if (isset($_GET["errorusuario"]) && $_GET["errorusuario"] == "si") { ?>
      <script language="JavaScript"> muestra('DATOS DEL USUARIO NO VALIDO'); </script> <?php }
  } ?>

</body>

</html>