<?php
include "../includes/header.php";
?>
<nav>
        <ul>
</li>

<li><strong><i><a href="../Ejercicio4/logout.php"><font size="4" face="Comic Sans MS,arial,verdana">Cerrar Sesión</font></a></i></strong>

</li>


</ul>
    </nav>
    <h3> Ejercicio 4</h3>

  </header>





<?php

//definimos las variables
require_once 'conex_bd.php';

session_start();
//recogemos el dato en el post si no hay ningun dato extraido aun de la sesion anterior
if (empty($_SESSION["nombreUsuario"])) {
    $nombreUsuario = $_POST["nombreUsuario"];
    $password = $_POST["password"];

} else {
//usamos los datos de la sesion anterior
    $nombreUsuario = $_SESSION["nombreUsuario"];
    $password = $_SESSION["contraseña"];

}

//preparamos la sentencia para comprobar el nombre
$sqlUser = $dbh->prepare("SELECT * from usuarios where nombreUsuario=?");

$sqlUser->execute(array($nombreUsuario));
$resultado = $sqlUser->fetch();

//comprobamos que el usuario existe y verificamos el password con el resultado obtenido
if (empty($resultado) || !password_verify($password, $resultado['contraseña'])) {?>


<script type="text/javascript">
            alert("Usuario o Password erróneos. Vuelva a intentarlo");
            </script>
                <?php
                include("index.php");

} else {

    //ocultamos errores para que no aparezcan en el html
    error_reporting(0);

    $tipoMov = $_POST["tipoMov"];
    $fecha = $_POST["fecha"];
    $nombre = $_POST["nombre"];
    $importe = $_POST["importe"];

    $sql = 'INSERT INTO `movimientos` (`tipoMov`,`fecha`, `nombre`, `importe`,`nombreUsuario`)values(?,?,?,?,?)';

    $sth = $dbh->prepare($sql);

    $sth->execute(array($tipoMov, $fecha, $nombre, $importe, $nombreUsuario));

//creamos un form
    ?>


<p>Login correcto.</p>

<form action="#" method="post">
    <?php
//iniciamos sesion siempre que queramos conectarnos a nuestra BBDD
    //mejor ponemos el formulario de gastos en otro archivo con el ingreso y gasto

    $_SESSION['nombreUsuario'] = $resultado['nombreUsuario'];
    $_SESSION['contraseña'] = $password;

    ?>
        <a id="inputPedido" href="../Ejercicio4/resultado.php">Resultado Web</a>
        <br>
        <br>
        <a id="inputPedido" href="../Ejercicio4/mpdf.php">Tabla en PDF</a>

        <br>
        <br>

    <p> <strong> Pulse Alta para registrar cada movimiento en la BBDD</strong> </p>

    <div class="altaBalance">
        <p>Elija un tipo de movimiento: </p>

        Ingreso <input type="radio" id="inputPedido" name="tipoMov" value="ingreso">
        <br>
 Gasto <input type="radio" id="inputPedido" name="tipoMov" value="gasto"><br>
<br>
        <p>Rellena los datos</p>
        Fecha: <input type="date" name="fecha"><br>
        Descripción: <input type="text" name="nombre"><br>
        Cantidad: <input type="number" name="importe"><br>


        <input type="submit" id="inputPedido" value="Alta"><br>


        <?php

    if ($sth->rowCount() > 0) {
        ?>
        <script type="text/javascript">
        alert("Ok. Movimiento dado de alta en la BBDD");
        </script> 
        <?php
    } else {
        ?>
        <script type="text/javascript">
        alert("AYUDA: rellene todos los campos para dar de alta el movimiento");
        </script> 
        <?php
    }

    ?>
    </div>

</form>

</div>

<br>

<?php }
?>

<?php
include "../includes/footer.php";?>