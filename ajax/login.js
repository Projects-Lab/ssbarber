function ingresar() {
    $.ajax({
        type: "POST",
        url: "controladores/usuario.controlador.php",
        data: {
            metodo: "ingresar",
            data: $("#frmIniciar").serialize(),
        },
        dataType: "json",
        success: function (data) {
            if (data) {
                location.href = "inicio";
            } else {
                Swal.fire({
                    icon: 'error',
                    allowOutsideClick: false,
                    title: 'Error',
                    text: 'Usuario no encontrado o inactivo'
                });
            }
        },
    });
    return false;
}