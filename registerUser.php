

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

    </header>


  <?php
include("index.php");

require_once 'conex_bd.php';

//definimos las variables
$nombre = $_POST["nombre"];
$nombreUsuario = $_POST["nombreUsuario"];
//guardamos el password en una variable
$password= $_POST["password"];
//usamos el algoritmo hash bcrypt para generar clave de usuario
$password=password_hash($password,PASSWORD_BCRYPT);

//ejecutamos la sentencia
$sqlUser = $dbh->prepare("SELECT nombreUsuario from usuarios where nombreUsuario=?");

$sqlUser->execute(array($nombreUsuario));
$resultado = (int) $sqlUser->fetch();

if ($resultado == 1) {
    
    ?>

    echo'<script type="text/javascript">
            alert("Usuario elegido. Alta no satisfactoria");
            window.location.href="index.php";
            </script>';
        <?php
} else {

//insertamos el usuario para guardarlo en la BBDD con la clave hash

    $sql = "INSERT INTO usuarios values(?,?,?)";
    $sth = $dbh->prepare($sql);

    $sth->execute(array($nombre, $password, $nombreUsuario));
    


    ?>

echo'<script type="text/javascript">
        alert("Alta de usuario satisfactoria. Haz LOGIN");
        window.location.href="index.php";
        </script>';
    <?php
}

?>
