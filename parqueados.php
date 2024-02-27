<?php
$nombrePagina = "Parqueados";
include 'plantilla.php';
include 'header.php';

// Realizar la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$basedatos = "parking_plus_db";

// Crear una nueva conexión
$conexion = new mysqli($servername, $username, $password, $basedatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión a la base de datos tuvo un error: " . $conexion->connect_error);
}

// Consultar los vehiculos parqueados
$vehiculosParqueados = "SELECT * FROM vehiculos WHERE estado = 'parqueado'";
$resultado = $conexion->query($vehiculosParqueados);

// Obtener los datos como un array multidimensional
$vehiculos = $resultado->fetch_all(MYSQLI_ASSOC);

?>

<h3>Vehiculos Parqueados</h3>
<div class="contenedor-listado-parqueados">

    <table class="tabla">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Ingreso</th>
            </tr>
        </thead>
        <?php

        if (!empty($vehiculos)) {
            foreach ($vehiculos as $vehiculo) {
                echo "<tr>";
                echo "<td>";
                if ($vehiculo["tipoVehiculo"] == "carro") {
                    echo "<i class='fa-solid fa-car'></i>";
                } elseif ($vehiculo["tipoVehiculo"] == "moto") {
                    echo "<i class='fa-solid fa-motorcycle'></i>";
                } else {
                    echo "<i class='fa-solid fa-bullseye'></i>";
                }
                echo $vehiculo["placa"] . "</td>";

                echo "<td>" . $vehiculo["fechaHoraIngreso"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'> No hay vehículos parqueados </td> </tr>";
        }
        ?>
    </table>
</div>

<?php include 'footer.php'; ?>