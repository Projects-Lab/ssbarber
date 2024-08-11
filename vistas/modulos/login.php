<div class="content-login">
    <div class="login-box">
        <div class="card card-outline card-success">
            <div class="card-body">
                <form id="frmIniciar" method="post" onsubmit="return ingresar()" autocomplete="off">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="src\img\Logo_SSBarber.jpg" alt="Imagen de perfil" class="rounded mx-auto d-block"
                            style="max-width: 50%;">
                    </div>
                    <hr>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block mb-3">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>