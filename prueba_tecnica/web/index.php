<?php
include("../lib/funciones.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h3>Lista de empleados</h3>
            </div>
            <div class="col-6 text-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-user-plus"></i> Crear
                </button>

                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="" method="POST" id="empleadoForm">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Empleado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Nombre Completo *</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="nombre" class="form-control" id="inputPassword" placeholder="Nombre completo del empleado" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-3 col-form-label font-weight-bold">Correo electrónico *</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="correo" class="form-control" id="inputEmail" placeholder="Correo electrónico" required>
                                        </div> 
                                    </div> 
                                    <div class="form-group row">
                                        <label for="sexoH" class="col-sm-3 col-form-label font-weight-bold">Sexo *</label>
                                        <div class="col-sm-9 text-left">
                                            <div>
                                                <input type="radio" id="sexoH" name="sexo" value="M" required class="form-check-input">
                                                <label for="sexoH">Masculino</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="sexoM" name="sexo" value="F" required class="form-check-input">
                                                <label for="sexoM">Femenino</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Área *</label>
                                        <div class="col-sm-9">
                                            <select name="area" id="area" class="form-select form-control" required>
                                                <?php $empleados->areas($db); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="floatingTextarea2" class="col-sm-3 col-form-label font-weight-bold">Descripción *</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="descripcion" placeholder="Descripción de la experiencia del empleado" id="floatingTextarea2" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <div class="text-left">
                                                <input class="form-check-input" type="checkbox" id="boletin" name="boletin" value="1">
                                                <label for="boletin" class="form-check-label">Deseo recibir boletín informativo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label font-weight-bold">Roles * </label>
                                        <div class="col-sm-9">
                                            <?php $empleados->roles($db); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <input type="hidden" name="action" value="addEmpleado">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th><i class="fa fa-user"></i> Nombre</th>
                        <th>@ Email </th>
                        <th>Sexo</th>
                        <th>Area</th>
                        <th>Boletin</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $empleados->tablaEmpleados($db); ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
$(document).ready(function() {
    // Regla personalizada para validar al menos un checkbox seleccionado
    $("#empleadoForm").on("submit", function(e) {
    if ($("input[name='rol[]']:checked").length === 0) {
        e.preventDefault(); // Evita el envío del formulario
        alert("Por favor, seleccione al menos un rol.");
    }
});

    $.validator.addMethod("atLeastOneChecked", function(value, element) {
        return $("input[name='rol[]']:checked").length > 0;
    }, "Por favor, seleccione al menos un rol.");

    // Inicializar la validación
    $("#empleadoForm").validate({
        rules: {
            nombre: {
                required: true,
                pattern: /^[a-zA-ZÀ-ÿ\s]+$/
            },
            correo: {
                required: true,
                email: true
            },
            sexo: {
                required: true
            },
            area: {
                required: true
            },
            descripcion: {
                required: true
            },
            "rol[]": {  // Cambiado de "roles[]" a "rol[]"
                atLeastOneChecked: true,
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor ingrese el nombre.",
                pattern: "El nombre solo debe contener letras y espacios."
            },
            correo: {
                required: "Por favor ingrese su correo electrónico.",
                email: "Por favor ingrese un correo electrónico válido."
            },
            sexo: {
                required: "Por favor seleccione un sexo."
            },
            area: {
                required: "Por favor seleccione un área."
            },
            descripcion: {
                required: "Por favor ingrese una descripción."
            },
            "rol[]": {  // Cambiado de "roles[]" a "rol[]"
                atLeastOneChecked: "Por favor, seleccione al menos un rol.",
                required: "Por favor, seleccione al menos un rol."
            }
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            if (element.attr("name") == "rol[]") {
                error.addClass("invalid-feedback");
                element.closest(".col-sm-9").append(error);
            } else {
                error.addClass("invalid-feedback");
                element.closest(".col-sm-9").append(error);
            }
        },
        highlight: function(element) {
            if (element.name === "rol[]") {
                $(element).addClass("is-invalid");
            } else {
                $(element).addClass("is-invalid");
            }
        },
        unhighlight: function(element) {
            if (element.name === "rol[]") {
                $(element).removeClass("is-invalid");
            } else {
                $(element).removeClass("is-invalid");
            }
        }
    });
});

</script>
<?php 

    if(!empty($_POST)){
        if($action == "addEmpleado"){
            $empleados->addEmpleado($db, $nombre, $correo, $sexo, $area, $boletin, $descripcion, $rol);
        }elseif($action == "deleteEmpleado"){
            $empleados->deleteEmpleado($db, $id);
        }
    }

?>
</body>
</html>