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




<h1> <strong> Balance virtual Trassierra </strong></h1>

<?php


//definimos las variables
require_once 'conex_bd.php';

session_start();
$usuario = $_SESSION['nombreUsuario'];

$sth = $dbh->prepare("SELECT * from movimientos where nombreUsuario='$usuario'");
$sth->execute(array());

//tenemos que cambiar fetch o fetchAll dependiendo de los resultados que queremos que nos muestre
$resultado = $sth->fetchAll();

//seleccionamos la suma total de los ingresos y gastos
$sth1 = $dbh->prepare("SELECT SUM(importe) as total FROM `movimientos` WHERE tipoMov='ingreso' and nombreUsuario='$usuario';");
$sth1->execute();
//tenemos que cambiar fetch o fetchAll dependiendo de los resultados que queremos que nos muestre
$resultado1 = $sth1->fetch();

?>
<form action="#" method="post" class="formulario" >

<div>

<a id="inputPedido" href="../Ejercicio4/balance.php">Nuevo registro</a>
<br>
<br>
<a id="inputPedido" href="../Ejercicio4/mpdf.php">Tabla en PDF</a>

    <h3>Balance final</h3>
    <div>
        <table align="center">
            <tr>
                <th colspan="3">Ingresos</th>
            </tr>
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Importe</th>
            </tr>


            <?php

foreach ($resultado as &$fila) {

    if ($fila["tipoMov"] == "ingreso") {

        ?>
            <!--Bucle donde nos muestra las columnas correspondientes a nuestra tabla -->

            <tr>

                <td><?php echo $fila["fecha"]; ?></td>
                <td><?php echo $fila["nombre"]; ?></td>
                <td><?php echo $fila["importe"]; ?> €</td>


    </tr>

                <?php

    }}
?>
            <tr>

                <th colspan="2">Total ingresos:</th>
                <th><?php echo $resultado1["total"]; ?> €</th>
            </tr>
        </table>
    </div>
    <div>
        <table align="center">
            <tr>
                <th colspan="3">Gastos</th>
            </tr>


            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Importe</th>



            </tr>


            <?php

//seleccionamos la suma total de los ingresos y gastos
$sth2 = $dbh->prepare("SELECT SUM(importe) as total FROM `movimientos` WHERE tipoMov='gasto' and nombreUsuario='$usuario';");
$sth2->execute();
//tenemos que cambiar fetch o fetchAll dependiendo de los resultados que queremos que nos muestre
$resultado2 = $sth2->fetch();

foreach ($resultado as &$fila) {

    if ($fila["tipoMov"] == "gasto") {

        ?>
            <!--Bucle donde nos muestra las columnas correspondientes a nuestra tabla -->

            <tr>

                <td><?php echo $fila["fecha"]; ?></td>
                <td><?php echo $fila["nombre"]; ?></td>
                <td><?php echo $fila["importe"];
        $importe = +$fila["importe"] ?> €</td>
            </tr>

                <?php }}
?>
            <tr>

                <th colspan="2">Total gastos:</th>
                <th><?php echo $resultado2["total"]; ?> €</th>
            </tr>
        </table>
        <div>

            <table align="center">
                <tr>

                    <th colspan="2">Balance Final:</th>
                    <th><?php echo ($resultado1["total"] - $resultado2["total"]); ?> €</th>
                </tr>

            </table>

        </div>


    </div>

</div>
    </form>
 
<?php
include "../includes/footer.php";?>