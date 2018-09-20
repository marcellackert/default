<?php 
require("../config.inc.php");
require("classes/class.db.php");

$db = new DB($dbhost,$dbuser,$dbpw,$dbdatabase);

unset($meldung);

if (isset($_POST["eintragen"]))
{
    $sprache = $db->escape_string($_POST["sprache"]);
    $kurzform = strtoupper($db->escape_string($_POST["kurzform"]));

    if (empty($sprache) || empty($kurzform))
    {
        $meldung = "Bitte alle Felder ausfüllen.";
    }
    else    
    {
        $checksql = "select sprache from sprachen where sprache = '$sprache' or kurzform = '$kurzform'";
        $writesql = "insert into sprachen (sprache,kurzform) values ('$sprache','$kurzform')";
        $meldung = $db->calldb("checkwrite",$checksql,$writesql,"Die Sprache wurde angelegt.","Die Sprache existiert bereits");
    }
}

?>
<div class="content">
<?php if (isset($meldung)) echo "<b>$meldung</b><br/><br/>"; ?>
<b>Sprache hinzufügen</b><br/><br/>
<form method="post">
<input type="text" name="sprache" placeholder="Sprache"/><br/><br/>
<input type="text" name="kurzform" placeholder="Kurzform" size ="3"><br/><br/>
<input type="submit" name="eintragen" value="Anlegen"/>
</form>
</div>
<div class="right">bla</div>