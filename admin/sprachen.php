<?php 
require("functions/db_connect.php");
include("functions/db_checks.php");

if (isset($_POST["eintragen"]))
{
    $sprache = $mysqli->escape_string($_POST["sprache"]);
    $kurzform = strtoupper($mysqli->escape_string($_POST["kurzform"]));
    echo existcheck($sprache);

    if (empty($sprache) || empty($kurzform))
    {
        $meldung = "Bitte alle Felder ausfüllen.";
    }
    else    
    {
        $res = $mysqli->query("select sprache from sprachen where sprache = '$sprache' or kurzform = '$kurzform'");
        if ($res->num_rows > 0)
        {
            $meldung = "Sprache oder Kurzform bereits vorhanden.";
        }
        else
        {
            $mysqli->query("insert into sprachen (sprache,kurzform) values ('$sprache','$kurzform')");
            echo $mysqli->error;
            $meldung = "Die Sprache $sprache wurde angelegt.";
        }
    }
}

?>

<b><?php echo $meldung; ?></b><br/><br/>
<b>Sprache hinzufügen</b><br/><br/>
<form method="post">
<input type="text" name="sprache" placeholder="Sprache"/><br/><br/>
<input type="text" name="kurzform" placeholder="Kurzform" size ="3"><br/><br/>
<input type="submit" name="eintragen" value="Anlegen"/>
</form>