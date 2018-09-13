<?php 

    class DB { 
        
        protected $dbhost = "localhost";
        protected $dbuser = "root";
        protected $dbpw = "";
        protected $dbdatabase = "friendsbattle";
        public $db = null;
        
        public function __construct() { 
            $this->connect(); 
        } 
        public function connect() { 
            $db = new mysqli($this->dbhost,$this->dbuser,$this->dbpw,$this->dbdatabase);
            if ($db->connect_errno)
            {
                echo "Die Verbindung zur Datenbank konnte nicht hergestellt werden.<br/>Wir arbeiten bereits daran das Problem zu beheben.";
            }
            $db->set_charset("utf-8");
            $this->db = $db;
        } 

        public function existcheck($checksql, $writesql, $oktext, $wrongtext)
        {        
            $res = $this->db->query($checksql);
            echo "<pre>";
            var_dump($res->num_rows);
            echo "</pre>";
            if ($res->num_rows > 0)
            {
                return $wrongtext;
            }
            else
            {
                return $oktext;
                //return dbwrite($db, $writesql, $oktext);
            }   
        }  

        function dbwrite($db, $writesql, $oktext)
        {
            $db->query($writesql);
            return $oktext;
        }
    } 
?>

