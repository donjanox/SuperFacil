<?php
include("conexion.php");

ob_start(); // Inicia el búfer de salida

if (isset($_POST['send'])) {
    if (
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['password']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['phone']) >= 1
    ) {
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $fecha = date("d/m/y");
        $consulta = "INSERT INTO datos(nombre, contraseña, email, telefono, fecha)
                     VALUES ('$name', '$password', '$email', '$phone', '$fecha')";
        $resultado = mysqli_query($conex, $consulta);
        if ($resultado) {
            // Limpia el búfer antes de la redirección
            ob_end_clean();
            // Redireccionar a tu página HTML después de insertar en la base de datos
            header("Location: principal.html");
            exit(); // Asegura que el script se detenga después de la redirección
        } else {
            ?>
            <h3 class="error">Ocurrió un error inesperado</h3>
            <?php
        }
    } else {
        ?>
        <h3 class="error">Llena todos los campos</h3>
        <?php
    }
}

ob_end_flush(); // Limpia y envía el búfer de salida al navegador
?>