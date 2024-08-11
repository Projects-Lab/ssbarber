<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SS Barber</title>
  <link rel="shortcut icon" href="" type="image/x-icon">
  <link rel="stylesheet" href="src/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="src/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="src/plugins/select2/css/select2.min.css">
  <link rel="icon" type="image/x-icon" src="src\img\Logo_SSBarber.jpg">
  <link rel="shortcut icon" href="src\img\Logo_SSBarber.jpg" type="image/x-icon">
  <link rel="stylesheet" href="src/css/adminlte.css">
  <link rel="stylesheet" href="src/css/estilos.css">
  <link rel="stylesheet" href="src/plugins/sweetalert2/sweetalert2.min.css">

  <script src="src/plugins/jquery/jquery.min.js"></script>
  <script src="src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="src/js/adminlte.js"></script>
  <script src="src/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="src/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="src/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="src/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="src/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="src/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="src/plugins/jszip/jszip.min.js"></script>
  <script src="src/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="src/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="src/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="src/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="src/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="src/plugins/select2/js/select2.min.js"></script>
  <script src="src/plugins/inputmask/jquery.inputmask.min.js"></script>
  <script src="src/js/loadingoverlay.min.js"></script>
  <script src="src/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="src/js/calculoDigito.js"></script>
  <script src="src/js/bootstrap-autocomplete.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <?php
  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    echo '<div class="wrapper">';

    include "modulos/cabezote.php";
    include "modulos/menu.php";
    $registrindo = "modulos/401.php";
    if (isset($_GET["ruta"])) {

      switch ($_GET["ruta"]) {
        case 'inicio':
          include "modulos/" . $_GET["ruta"] . ".php";
          break;
        case 'eps':
          if ($_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
        case 'citas':
          if ($_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
        case 'cargos':
          if ($_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
        case 'empleados':
          if ($_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
          case 'servicios':
            if ($_SESSION["perfil"] == "Administrador") {
              include "modulos/" . $_GET["ruta"] . ".php";
            } else {
              include $registrindo;
            }
            break;
        case 'clientes':
          if ($_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
        case 'inventario':
          if ($_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
        case 'ventas':
          if ($_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
        case 'usuarios':
          if ($_SESSION["perfil"] == "Administrador") {
            include "modulos/" . $_GET["ruta"] . ".php";
          } else {
            include $registrindo;
          }
          break;
        case 'salir':
          include "modulos/" . $_GET["ruta"] . ".php";
          break;
        default:
          include "modulos/404.php";
          break;
      }
    } else {
      include "modulos/inicio.php";
    }

    include "modulos/footer.php";
    echo '</div>';
  } else {
    include "modulos/login.php";
    echo '<script src="ajax/login.js"></script>';
  }

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    if (isset($_GET["ruta"])) {
      if ($_GET["ruta"] == "citas") {
        echo '<script src="ajax/citas.js"></script>';
      }
      if ($_GET["ruta"] == "cargos") {
        echo '<script src="ajax/cargos.js"></script>';
      }
      if ($_GET["ruta"] == "servicios") {
        echo '<script src="ajax/servicios.js"></script>';
      }
      if ($_GET["ruta"] == "pacientes") {
        echo '<script src="ajax/paciente.js"></script>';
      }
      if ($_GET["ruta"] == "usuarios") {
        echo '<script src="ajax/usuarios.js"></script>';
      }
      if ($_GET["ruta"] == "clientes") {
        echo '<script src="ajax/clientes.js"></script>';
      }
      if ($_GET["ruta"] == "inventario") {
        echo '<script src="ajax/productos.js"></script>';
      }
      if ($_GET["ruta"] == "ventas") {
        echo '<script src="ajax/ventas.js"></script>';
      }
      if ($_GET["ruta"] == "empleados") {
        echo '<script src="ajax/empleados.js"></script>';
      }
    }
  }
  ?>
</body>

</html>