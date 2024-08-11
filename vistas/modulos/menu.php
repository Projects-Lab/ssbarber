<!-- main sidebar container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- LOGO -->
    <a href="inicio" class="brand-link">
        <img src="src\img\Logo_SSBarber.jpg" alt="ssbarber" class="brand-image text-center ">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <?php if ( $_SESSION["perfil"] == "Administrador") : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-cube" aria-hidden="true"></i>
                            <p>
                                Administracion
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="servicios" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Servicios</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="cargos" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cargos</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="empleados" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Empleados</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if ($_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") : ?>
                    <!-- Citas -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <p>
                                Citas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="citas" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if ( $_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") : ?>
                    <!-- Pacientes -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <p>
                                Clientes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="clientes" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if ($_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") : ?>
                    <!-- Inventario -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <p>
                                Inventario / Productos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="inventario" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if ($_SESSION["perfil"] == "Recepcion" || $_SESSION["perfil"] == "Administrador") : ?>
                    <!-- Ventas -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-building" aria-hidden="true"></i>
                            <p>
                                Facturas / Ventas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="ventas" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if ($_SESSION["perfil"] == "Administrador") : ?>
                    <!-- Usuarios-->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <p>
                                Usuarios
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="usuarios" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gestionar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
            <nav>
    </div>
</aside>