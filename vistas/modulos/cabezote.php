<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="inicio" class="nav-link">Inicio</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
         <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="fas fa-grip-horizontal"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">En linea</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> <?php echo $_SESSION["nombre"]?>
          <!-- debe venir de la bade datos -->
                     
          </a>
          
          <a href="#" class="dropdown-item">
          <i class="fas fa-key mr-2"></i> <?php echo $_SESSION["perfil"]?>
          <!-- debe venir de la bade datos -->
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="salir" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Salir del sistema
            
          </a>
         
      </li>
    </ul>
   
  </nav>

