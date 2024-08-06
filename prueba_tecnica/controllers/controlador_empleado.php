<?php

class empleados{

    public function areas($db){
        $areas = $db->query("SELECT*FROM areas");

        while($ar = mysqli_fetch_array($areas)){
            echo '<option value="'.$ar[0].'">'.$ar[1].'</option>';
        }
    }
    
    public function areasEdit($db, $id){
        $areas = $db->query("SELECT*FROM areas");

        while($ar = mysqli_fetch_array($areas)){
            if($id == $ar[0]){
                $select = "selected";
            }else{
                $select = "";
            }
            echo '<option value="'.$ar[0].'" '.$select.'>'.$ar[1].'</option>';
        }
    }

    public function roles($db){
        $roles = $db->query("SELECT*FROM roles");

        while($rol = mysqli_fetch_array($roles)){
            echo '
            <div class="text-left">
                <input type="checkbox" id="rol'.$rol[0].'" name="rol[]" value="'.$rol[0].'" class="form-check-input">
                <label for="rol'.$rol[0].'" class="form-check-label">'.$rol[1].'</label>
            </div>
            ';
        }
    }

    public function rolesEdit($db, $id){
        $roles = $db->query("SELECT*FROM roles");

        while($rol = mysqli_fetch_array($roles)){
            $countSelect = $db->HallaValorUnico("SELECT COUNT(a.id) FROM empleado_rol a WHERE empleado_id = $id AND rol_id = ".$rol[0]." ");

            if($countSelect > 0){ $checked = "checked"; }else{
                $checked = "";
            }
            echo '
            <div class="text-left">
                <input type="checkbox" '.$checked.'  id="rol'.$rol[0].'" name="rol[]" value="'.$rol[0].'" class="form-check-input">
                <label for="rol'.$rol[0].'" class="form-check-label">'.$rol[1].'</label>
            </div>
            ';
        }
    }

    public function addEmpleado($db, $nombre, $email, $sexo, $area, $boletin, $descripcion, $rol){

        //con la funcion query del conex realizamos el insert en la tabla de empleados
        $db->query("INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion) VALUES ('$nombre', '$email', '$sexo', '$area', '$boletin', '$descripcion') ");

        $id_empleado = $db->HallaValorUnico("SELECT id FROM empleados ORDER BY id DESC LIMIT 1");
        $nId = $id_empleado+1;

        $rolesSeleccionados = $rol;
        // Mostrar los roles seleccionados
        foreach ($rolesSeleccionados as $rol) {
            $db->query("INSERT INTO empleado_rol (rol_id, empleado_id) VALUES ('$rol', '$nId')");
        }

        echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
            title: 'Listo',
            text: 'Guardado Correctamente',
            icon: 'success'
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                location.replace('')
            }
            })
        </script>";
    }

    public function editEmpleado($db, $nombre, $email, $sexo, $area, $boletin, $descripcion, $rol, $id){

        //con la funcion query del conex realizamos el insert en la tabla de empleados
        $db->query("UPDATE empleados SET nombre = '$nombre', email = '$email', sexo = '$sexo', area_id = '$area', boletin = '$boletin', descripcion = '$descripcion' WHERE id = $id ");

        $db->query("DELETE FROM empleado_rol WHERE empleado_id = '$id'");

        $rolesSeleccionados = $rol;
        // Mostrar los roles seleccionados
        foreach ($rolesSeleccionados as $rol) {
            $db->query("INSERT INTO empleado_rol (rol_id, empleado_id) VALUES ('$rol', '$id')");
        }

        echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
            title: 'Listo',
            text: 'Actualizado Correctamente',
            icon: 'success'
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                location.replace('index.php')
            }
            })
        </script>";
    }

    public function deleteEmpleado($db, $id){

        //con la funcion query del conex realizamos el insert en la tabla de empleados
        $db->query("DELETE FROM empleados WHERE id = $id");
        $db->query("DELETE FROM empleado_rol WHERE empleado_id = $id");

        echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
            title: 'Listo',
            text: 'Eliminado Correctamente',
            icon: 'success'
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                location.replace('')
            }
            })
        </script>";
    }

    public function tablaEmpleados($db){

        $empleados = $db->query("SELECT * FROM empleados a INNER JOIN areas b ON a.area_id = b.id");

        while($emp = mysqli_fetch_array($empleados)){
        ?>
            <tr>
                <td><?php echo $emp[1]; ?></td>
                <td><?php echo $emp[2]; ?></td>
                <td><?php if($emp[3] == "M") {echo "Masculino";}else{ echo "Femenino"; } ?></td>
                <td><?php echo $emp[8]; ?></td>
                <td><?php if($emp[5] == "1") {echo "Si";}else{ echo "No"; } ?></td>
                <td>
                    <!-- Button trigger modal -->
                    <a class="btn btn-success" href="edit_empleado.php?id=<?php echo $emp[0]?>">
                        <i class="fa fa-pencil"></i>
                    </a>
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalEdit<?php echo $emp[0]; ?>">
                    <i class="fa fa-trash"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade bd-example-modal-lg" id="exampleModalEdit<?php echo $emp[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="" method="POST" id="empleadoForm">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Empleado</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Seguro que desea eliminar este empleado?, esta acción no puede ser revertida</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <input type="hidden" name="action" value="deleteEmpleado">
                                        <input type="hidden" name="id" value="<?php echo $emp[0]; ?>">
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php
        }
    }
}