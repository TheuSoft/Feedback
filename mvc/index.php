<?php
include "generic/Autoload.php";

use generic\Controller;

$controller = new Controller();

if (isset($_GET["param"])) {
    $controller->verificarChamadas($_GET["param"]);
} else {
    // Redireciona para a lista de usuários quando nenhum parâmetro é fornecido
    $controller->verificarChamadas("usuario/lista");
}
