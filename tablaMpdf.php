<?php

function getPlantilla(){

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


     $plantilla='
   

     <form action="#" method="post" class="formulario" >

     <div>
     
     <a id="inputPedido" href="../Ejercicio4/balance.php">Nuevo registro</a>
     <br><br>
     <a id="inputPedido" href="../Ejercicio4/resultado.php">Resultado Web</a>

        <h3><strong>Balance final</strong></h3>
        <br><br>

        <table  align="center">
                <tr >
                    <th colspan="3"><strong>Ingresos</strong></th>
                </tr>

                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Importe</th>
                </tr>
                ';
//concatenamos con '; y volvemos a declarar la variable para que podamos ir haciendo las tablas

                foreach ($resultado as &$fila) {

                if ($fila["tipoMov"] == "ingreso") {

                $plantilla .='
                <!--Bucle donde nos muestra las columnas correspondientes a nuestra tabla -->

                <tr>

                    <td>' .$fila["fecha"] .'</td>
                    <td>' .$fila["nombre"] .'</td>
                    <td>' .$fila["importe"] .' €</td>


                </tr>

                ';
            }}
            $plantilla.='


                <tr>

                    <th colspan="2"><strong>Total ingresos:</strong></th>
                    <th>' .$resultado1["total"] .' €</th>
                </tr>
            </table>
        </div>
        <br><br>

        <div>
            <table align="center">
                <tr>
                    <th colspan="3"><strong>Gastos</strong></th>
                </tr>


                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Importe</th>



                </tr>


';


//seleccionamos la suma total de los ingresos y gastos
$sth2 = $dbh->prepare("SELECT SUM(importe) as total FROM `movimientos` WHERE tipoMov=`gasto` and nombreUsuario=`$usuario`;");
$sth2->execute();
//tenemos que cambiar fetch o fetchAll dependiendo de los resultados que queremos que nos muestre
$resultado2 = $sth2->fetch();
foreach ($resultado as &$fila) {

    if ($fila["tipoMov"] == "gasto") {

        $plantilla.='
        <!--Bucle donde nos muestra las columnas correspondientes a nuestra tabla -->

        <tr>

        <td>' .$fila["fecha"] .'</td>
        <td>' .$fila["nombre"] .'</td>
        <td>' .$fila["importe"] .' €</td>


    </tr>

    ';
}}
$plantilla.='
   <tr>

                    <th colspan="2"><strong>Total gastos:</strong></th>
                    <th>' .$resultado2["total"].' €</th>
                </tr>
            </table>
            <br><br>

            <div>

                <table align="center">
                    <tr>

                        <th colspan="2"> <strong> Balance Final:</strong> </th>
                        <th>' .($resultado1["total"] - $resultado2["total"]) .' €</th>
                    </tr>

                </table>

            </div>


        </div>

</form>


';

return $plantilla;
       }
       ?>