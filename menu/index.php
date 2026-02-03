<?php include 'vars.php'; ?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Menu para la aplicacion SIPAP 6.0">
    <meta name="author" content="@noemdb: Desarrollador Senior Laravel">
    <title>SISTEMA INTEGRADO PARA LA ADMINISTRACIÓN PÚBLICA SIPAP 6.0</title>

    <!-- Modern UI Styles -->
    <link href="./css/modern.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="./vendor/fontawesome/5.2.0/css/all.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">

      <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand">SIPAP 6.0</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="./menu.html">Inicio</a>
            <a class="nav-link" href="./caracteristicas.html">Características</a>
            <!-- <a class="nav-link" href="#">Contacto</a> -->
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover">
        
        <hr class="color1"><hr class="color2">

        <svg height="90" width="90">
          <rect x="5" y="5" rx="5" ry="5" width="80" height="80" class="box1" />
        </svg>
        <svg height="90" width="90">
          <rect x="5" y="5" rx="5" ry="5" width="80" height="80" class="box2" />
        </svg>
        <h1 class="cover-heading">
          SISTEMA INTEGRADO PARA LA ADMINISTRACIÓN PÚBLICA SIPAP 6.0
        </h1>
        <svg height="90" width="90">
          <rect x="5" y="5" rx="5" ry="5" width="80" height="80" class="box3" />
        </svg>
        <svg height="90" width="90">
          <rect x="5" y="5" rx="5" ry="5" width="80" height="80" class="box4" />
        </svg>

        <hr class="color3"><hr class="color4">


        <div class="btn-group btn-block btn-group-lg mb-2" role="group" aria-label="Basic example">

          <?php foreach ($arr_module as $k => $v): ?>

            <a href="<?php echo $url.$k ?>" title="<?php echo $v['nom_module'] ?>" class="btn btn-<?php echo $v['color'] ?> btn-sm">
              <i class="<?php echo $v['icon'] ?>"></i>
            </a>
            
          <?php endforeach ?>

        </div>

      </main>

      <footer class="mastfoot mt-auto" style="opacity: 0.4;">
        <div class="inner">
          <small class="text-muted">
          <p>Basado en <a href="https://getbootstrap.com/">Bootstrap</a> Desarrollado por: <a href="https://twitter.com/noemdb">@noemdb</a></p>
        </small>
        </div>
      </footer>

  </div>


</body>


<!--
<script type="text/javascript" src="bootstrap/jquery-slim.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.bundle.min.js"></script>
-->

</html>