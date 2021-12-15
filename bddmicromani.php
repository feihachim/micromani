<?php
require("config.php");

$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD);
/*$test = $db->prepare("SELECT * FROM jeux_video");
$test->execute();
$succes = $test->rowCount();
if ($succes >0) {
    echo "ALL GREEN";
} else {
    echo "ECHEC";
}*/
