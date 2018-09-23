<?php 
    class DB extends mysqli { 

        //Objekt Attribute
        private $sqlerg;
        private $sqlok = null;
        private $sqlfalse = null;
        private $sqlread = null;
        private $sqlwrite = null;
        
        //Konstruktor - Herstellen der Verbindung
        public function __construct($host,$user,$pw,$database) { 
            parent::__construct($host,$user,$pw,$database);
            if ($this->connect_errno)
            {
                echo "Die Verbindung zur Datenbank konnte nicht hergestellt werden.<br/>Wir arbeiten bereits daran das Problem zu beheben.";
            }
            $this->set_charset("utf-8");
        } 

        /* 
            Die Methode speichert zunächst die Anfragenattribute und führt dann die angeforderte Operation aus.

            params:
            $action -> Aktion die ausgeführt werden soll. 
                Verfügbare Werte: 
                                    checkonly  - Prüfen ob für $checksql bereits ein Eintrag vorhanden ist
                                    checkwrite - Prüfen ob für $checksql bereits ein Eintrag vorhanden ist, wenn nicht speichern
                                    write      - $writesql in die Datenbank schreiben
            $checksql    -> SQL Statement das geprüft werden soll
            $writesql    -> SQL Statement das ausgeführt werden soll
            $okmessage   -> Nachricht die zurück gegeben werden soll, wenn der Eintrag noch nicht existiert
            $falsmessage -> Nachricht die zurück gegeben werden soll, wenn der Eintrag bereits existiert
        */
        public function calldb($action,$checksql,$writesql,$okmessage,$falsemessage)
        {
            $this->sqlok = $okmessage;
            $this->sqlfalse = $falsemessage;
            $this->sqlread = $checksql;
            $this->sqlwrite = $writesql;
            
            if ($action == "checkonly") 
            { 
                $this->existcheck(null); 
            }
            if ($action == "checkwrite")
            {
                $this->existcheck("write");
            }
            if ($action == "write")
            {
                $this->write();
            }
            if ($action == "readone")
            {
                $this->readone();
            }
            if ($action == "readall")
            {
                $this->readall();
            }
            return $this->sqlerg;
        }

        /* 
           Die Methode prüft ob ein Eintrag bereits vorhanden ist. 
           wenn sie mit dem Befehl "write" aufgerufen wird ruft sie 
           im Anschluss die write Methode auf, sofern der Eintrag noch nicht existiert.
        */
        private function existcheck($action)
        {        
            $res = $this->query($this->sqlread);
            if ($res->num_rows > 0)
            {
                $this->sqlerg = $this->sqlfalse;
            }
            else
            {
                $this->sqlerg = $this->sqlok;
                if ($action == "write") 
                {
                     $this->dbwrite(); 
                }
            }  
        } 

        //Schreibt Attribut sqlwrite in die Datenbank
        private function dbwrite()
        {
            $this->query($this->sqlwrite);
        }

        //Speichert eine Zeile im Objekt
        private function readone()
        {
             $result = $this->query($this->sqlread);
             $this->sqlerg = $result->fetch_object();
        }

        //Speichert Array der Abfrage im Objekt
        private function readall()
        {
            $result = $this->query($this->sqlread);
            while ($data = $result->fetch_object())
            {
                $this->sqlerg[] = $data; 
            }
        }

    } 
?>