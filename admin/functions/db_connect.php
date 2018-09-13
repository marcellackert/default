<?php
require("../config.inc.php");
$mysqli = new mysqli($dbhost,$dbuser,$dbpw,$dbdatabase);
if ($mysqli->connect_errno)
{
    echo "Die Verbindung zur Datenbank konnte nicht hergestellt werden.<br/>Wir arbeiten bereits daran das Problem zu beheben.";
}
$mysqli->set_charset("utf-8");
?>