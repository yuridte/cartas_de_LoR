<?php
class DB{
    private $host;
    private $port;
    private $dbName;
    private $user;
    private $password;

    public function __construct($cfgHost, $cfgPort, $cfgDbName, $cfgUser, $cfgPassword){
        $this->setHost($cfgHost);
        $this->setPort($cfgPort);
        $this->setDbName($cfgDbName);
        $this->setUser($cfgUser);
        $this->setPassword($cfgPassword);

        return true;
    }
    // __construct() END

    //getters and setters
    public function getHost(){
        return $this->host;
    } 

    public function setHost($host){
        $this->host = $host;
        return true;
    }

    public function getPort(){
        return $this->port;
    }

    public function setPort($port){
        $this->port = $port;
        return true;
    }

    public function getDbName(){
        return $this->dbName;
    }

    public function setDbName($dbName){
        $this->dbName = $dbName;
        return true;
    }

    private function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
        return true;
    }

    private function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
        return true;
    }
    //getters and setters END


    public function getConnection(){
        //starting database variable
        $dbConnection = null;
    
        try {
            //open connection
            $dbConnection = new PDO("mysql:
                    host=$this->host;
                    port=$this->port;
                    dbname=$this->dbName;
                    charset=utf8mb4", 
                $this->user, 
                $this->password, 
                array(
                    PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION
                    )
                );

            return $dbConnection;
            
        } catch (PDOException $e) {
            //database connection errors
            echo "Error!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }
    //getConnection() END

}
