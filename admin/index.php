<?php 
require("../config.inc.php");
if (isset($_REQUEST["page"])) $page = $_REQUEST["page"];
else $page = "welcome";
//Standard Variable Meldung anlegen, diese wird in den Includes zur Ausgabe verwendet
$meldung = "";
?>
<html>
    <head>
        <title>Friendsbattle Adminbereich</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="adminstyle.css">
    </head>
    <body>
        <!-- Header -->
        <div class="header">
            Friendsbattle Adminbereich
        </div>
        <!-- Menü -->
        <div class="menu"><?php include("menu.php"); ?></div>
        <!-- Content -->
        <?php include("$page.php"); ?>
    </body>
</html>