<?php
include("../lib/funciones.php");

$cEmpleados = $db->query("SELECT * FROM empleados a INNER JOIN areas b ON a.area_id = b.id where a.id = ".$_GET["id"]);
$emp = $db->fetch_array($cEmpleados);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="container mt-5">
        <h3>Editar Empleado</h3>
        
        <form action="" method="POST" id="empleadoForm">
            <div class="form-group row">
                <label for="nombre" class="col-sm-3 col-form-label font-weight-bold">Nombre Completo *</label>
                <div class="col-sm-9">
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre completo del empleado" required value="<?php echo $emp[1] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="correo" class="col-sm-3 col-form-label font-weight-bold">Correo electrónico *</label>
                <div class="col-sm-9">
                    <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo electrónico" required value="<?php echo $emp[2] ?>">
                </div> 
            </div> 
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bold">Sexo *</label>
                <div class="col-sm-9">
                    <?php
                        if($emp[3] == "F"){
                            $sexoM = "";
                            $sexoF = "checked";
                        }else{
                            $sexoM = "checked";
                            $sexoF = "";
                        }
                    ?>
                    <div class="form-check">
                        <input type="radio" id="sexoH" name="sexo" value="M" required class="form-check-input" <?php echo $sexoM; ?> >
                        <label for="sexoH" class="form-check-label">Masculino</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="sexoM" name="sexo" value="F" required class="form-check-input" <?php echo $sexoF; ?>>
                        <label for="sexoM" class="form-check-label">Femenino</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="area" class="col-sm-3 col-form-label font-weight-bold">Área *</label>
                <div class="col-sm-9">
                    <select name="area" id="area" class="form-control" required>
                        <?php $empleados->areasEdit($db, $emp[4]); ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="descripcion" class="col-sm-3 col-form-label font-weight-bold">Descripción *</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="descripcion" placeholder="Descripción de la experiencia del empleado" id="descripcion" required><?php echo $emp[6] ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="boletin" name="boletin" value="1" <?php if($emp[5] == "1"){ echo "checked"; } ?>>
                        <label for="boletin" class="form-check-label">Deseo recibir boletín informativo</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bold">Roles * </label>
                <div class="col-sm-9">
                    <?php $empleados->rolesEdit($db, $_GET["id"]); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <a href="index.php" class="btn btn-info">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <input type="hidden" name="action" value="editEmpleado">
                </div>
            </div>
        </form>
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
        if($action == "editEmpleado"){
            $empleados->editEmpleado($db, $nombre, $correo, $sexo, $area, $boletin, $descripcion, $rol, $_GET["id"]);
        }
    }

?>
</body>
</html>