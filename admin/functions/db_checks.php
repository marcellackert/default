<?php

//Funktion um zu prüfen ob ein Datenbank Eintrag existiert
function existcheck($query)
{
    if ($query % 2 == 0)
        dbwrite($query);
    else
        return ("Ungerade");
}   

//Funktion zum speichern von Daten
function dbwrite($query)
{
    echo "gespeichert";
    return "ist drin";
}

?>