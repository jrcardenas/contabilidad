
  <?php

/* session_start();
$_SESSION=array();
session_destroy();

Cerramos sesion y borramos los datos
 */
session_start();
$_SESSION = array();
setcookie(session_name(), '', time() - 2592000, '/');
session_destroy();

include("index.php");

?>


</div>
