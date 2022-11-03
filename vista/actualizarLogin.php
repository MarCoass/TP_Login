<?php include_once('./common/header.php');
$datos = data_submitted();
$objSession = new Session();
$objSession->iniciar($datos['usuario'], $datos['contrasenia']);
print_r ($objSession);
print_r ($objSession->validar());

?>

<?php include_once('common/footer.php') ?>