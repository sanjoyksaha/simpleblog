<?php
    /*
    *
    * PDO Database Class
    * Contect To Database
    * Create Prepare Statements
    * Bind Values
    * Return Rows And Results
    *
    */

    class Database {
        private $db_host = DB_HOST;
        private $db_user = DB_USERNAME;
        private $db_pass = DB_PASSWORD;
        private $db_name = DB_NAME;

        private $db_handler;
        private $stmt;
        private $error;

        public function __construct()
        {
            // Set DSN
            $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            );
            
            // Create PDO  instance
            try{
                $this->db_handler = new PDO($dsn, $this->db_user, $this->db_pass, $options);
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepare statement with query
        public function query($sql)
        {
            $this->stmt = $this->db_handler->prepare($sql);
        }

        // Bind Values
        public function bind($param, $value, $type = null)
        {
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                    break;

                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                    break;

                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                    break;

                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindValue($param, $value, $type); 
        }

        //Execute prepared statement
        public function execute()
        {
            return $this->stmt->execute();
        }

        // Get result set as array of objects
        public function findAll()
        {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get Single Record as object 
        public function single()
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Get Row Count
        public function rowCount()
        {
            return $this->stmt->rowCount();
        }

    }