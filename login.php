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
require_once 'conex_bd.php';

session_start();
//recogemos el dato en el post si no hay ningun dato extraido aun de la sesion anterior
if( empty ($_SESSION["nombreUsuario"])){
  $nombreUsuario = $_POST["nombreUsuario"];
  $password = $_POST["password"];
  

}else{
//usamos los datos de la sesion anterior
  $nombreUsuario = $_SESSION["nombreUsuario"];
  $password = $_SESSION["contraseña"];

}

//definimos las variables



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
     <div class="login">

<form action="#" method="post" class="formulario">
<?php


//iniciamos sesion siempre que queramos conectarnos a nuestra BBDD
//mejor ponemos el formulario de gastos en otro archivo con el ingreso y gasto

$_SESSION['nombreUsuario'] = $resultado['nombreUsuario'];

//guardamos el password que ha introducido el usuario para despues volver a comprobarlo en el balance
$_SESSION['contraseña'] = $password;

    ?>
      <script type="text/javascript">
            alert("Registro satisfactorio");
            </script>
    <br>
    <div class="borde">
    <p>Selecciona Ingeso o Gasto </p>

Ingreso <input type="radio"  value="ingreso">
Gasto <input type="radio"  value="gasto"><br>


    </div>
    <div class="borde">
<p>Rellena los datos</p>
Fecha: <input type="date" name="fecha"><br>
Descripción: <input type="text" name="descripcion"><br>
Cantidad: <input type="number" name="cantidad"><br>


<input type="submit"id="inputPedido" value="Alta"><br>
<a href="../Ejercicio4/resultado.php">Balance Final</a>


<?php 
 
 if($sth->rowCount()>0){
     echo "Movimiento dado de alta correctamente en la BBDD";
     
         }else
         echo "No se ha dado de alta el movimiento. Rellene todos los campos";
     
     ?>
     </div>
 
 </form>
 
 </div>
 
 <br>
 
 <?php }
 ?>
 
<?php
include "../includes/footer.php";?>