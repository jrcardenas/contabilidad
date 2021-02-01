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


<div class="login">
<br>	
    <form action="balance.php" method="post" name="login" id="login">
    <h1>Login</h1>
    	<input type="text" name="nombreUsuario" placeholder="Username" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Log in</button>
        <br>
        </form>

        <form action="registerUser.php" method="post" name="login" id="login">

        <h1>Alta</h1>
        <input type="text" name="nombre" placeholder="Nombre y apellidos" required="required" />
  <input type="text" name="nombreUsuario" placeholder="Username" required="required" />
      <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Alta user</button>
        <br>
    </form>
    </div>



<?php

//tenemos que crear un composer.json y añadimos lo siguiente
/*
echo password_hash ("contraseña", $hash);

if password_verify("contraseña", $hash);


entramos en la carpeta del proyecto ycreamos un composer require mpdf/mpdf
{
"require":{

  "monolog/monolog":"1.0.*"
}}

hacemos los resultado en una tabla y despues esa tabla la
 pasamos a pdf con buscar mpdf y capture html output para extraer el pdf


*/

require_once 'conex_bd.php';

?>