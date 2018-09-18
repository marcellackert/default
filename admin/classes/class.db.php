<?php 

    class DB { 
        
        //Datenbank Konfiguration
        private $dbhost = "localhost";
        private $dbuser = "root";
        private $dbpw = "";
        private $dbdatabase = "friendsbattle";

        
        private $db = null;
        private $sqlmeldung;
        private $sqlok = null;
        private $sqlfalse = null;
        private $sqlcheck = null;
        private $sqlwrite = null;
        
        public function __construct() { 
            $db = new mysqli($this->dbhost,$this->dbuser,$this->dbpw,$this->dbdatabase);
            if ($db->connect_errno)
            {
                echo "Die Verbindung zur Datenbank konnte nicht hergestellt werden.<br/>Wir arbeiten bereits daran das Problem zu beheben.";
            }
            $db->set_charset("utf-8");
            $this->db = $db;
        } 

        public function calldb($action,$checksql,$writesql,$okmessage,$falsemessage)
        {
            $this->sqlok = $okmessage;
            $this->sqlfalse = $falsemessage;
            $this->sqlcheck = $checksql;
            $this->sqlwrite = $writesql;
            
            if ($action == 'check') 
            { 
                $this->existcheck(); 
            }
            return $this->sqlmeldung;
        }

        private function existcheck()
        {        
            $res = $this->db->query($this->sqlcheck);
            if ($res->num_rows > 0)
            {
                $this->sqlmeldung = $this->sqlfalse;
            }
            else
            {
                $this->sqlmeldung = $this->sqlok;
                $this->dbwrite();
            }  
        }  

        function dbwrite()
        {
            $this->db->query($this->sqlwrite);
        }
    } 
?>

