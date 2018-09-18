<?php 
require("functions/db_connect.php");
//require("functions/db_checks.php");
require("classes/class.db.php");

$wurst = new DB();

if (isset($_POST["eintragen"]))
{
    $sprache = $mysqli->escape_string($_POST["sprache"]);
    $kurzform = strtoupper($mysqli->escape_string($_POST["kurzform"]));

    if (empty($sprache) || empty($kurzform))
    {
        $meldung = "Bitte alle Felder ausfüllen.";
    }
    else    
    {
        $checksql = "select sprache from sprachen where sprache = '$sprache' or kurzform = '$kurzform'";
        $writesql = "insert into sprachen (sprache,kurzform) values ('$sprache','$kurzform')";
        //$meldung = $wurst->existcheck($checksql,$writesql,"Gespeichert","Sprache schon vorhanden");
        echo $wurst->calldb("check",$checksql,$writesql,"OK","FALSCH");
        /*
        else
        {
            $mysqli->query("insert into sprachen (sprache,kurzform) values ('$sprache','$kurzform')");
            echo $mysqli->error;
            $meldung = "Die Sprache $sprache wurde angelegt.";
        }
        */
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