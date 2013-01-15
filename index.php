<?php
/**
 * API pour récupérer une ville à partir d'un code postal
 * 
 * PHP version 5.4.6
 * 
 * @category API
 * @package  API_Postcode
 * @author   Pierre Rudloff <rudloff@strasweb.fr>
 * @license  LGPL http://www.gnu.org/licenses/lgpl.html
 * @link     http://rudloff.pro/
 * */
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
require 'config.php';
if (isset($_GET['codepos']) && !empty($_GET['codepos'])) {
    $query=$sql->query(
        'SELECT * FROM `Codes postaux` WHERE Codepos='.$sql->quote($_GET['codepos']).';'
    );
    $result=$query->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $result=(json_encode($result));
    } else {
        //Si on ne trouve pas, on prend le code le plus proche
        $code=substr_replace($_GET['codepos'], '', -3);
        $query=$sql->query(
            'SELECT * FROM `Codes postaux` WHERE Codepos='.$sql->quote($code.'000').';'
        );
        $result=$query->fetch(PDO::FETCH_ASSOC);
        $result=(json_encode($result));
    }
} else {
    $result=(json_encode(false));
}
header('ETag: '.md5($result));
print($result);
?>
