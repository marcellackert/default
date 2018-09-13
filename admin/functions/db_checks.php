<?php

//Funktion um zu prüfen ob ein Datenbank Eintrag existiert
function existcheck($db, $checksql, $writesql, $oktext, $wrongtext)
{
    
    $res = $db->query($checksql);
    
    if ($res->num_rows > 0)
    {
        return $wrongtext;
    }
    else
    {
        return dbwrite($db, $writesql, $oktext);
    }   
}   

//Funktion zum speichern von Daten
function dbwrite($db, $writesql, $oktext)
{
    $db->query($writesql);
    return $oktext;
}

?>