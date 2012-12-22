<?php
header('Content-Type: application/json');
require 'config.php';
if (isset($_GET['codepos']) && !empty($_GET['codepos'])) {
    $query=$sql->query('SELECT Commune, Departement, INSEE FROM `Codes postaux` WHERE Codepos='.$_GET['codepos'].';');
    $result=$query->fetch(PDO::FETCH_ASSOC);
    print(json_encode($result));
} else {
    print(json_encode(false));
}
?>
