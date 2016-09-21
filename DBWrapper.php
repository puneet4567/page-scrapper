<?php
define('DB_HOST', '127.0.0.1');  
define('DB_USER', 'root');
define('DB_PASSWORD', '1q2w3e4r');
define('DB_NAME', 'IA');

class DBWrapper
{
    private $dbConnection;

  public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }

    public function Open(){
            $this->dbConnection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    }

    public function Close() {
        if($this->dbConnection != null) {
            mysqli_close($this->dbConnection);
            $this->dbConnection = null;
        }
    }

    public function executeQuery($queryToRun) {
        if($this->dbConnection != null) {
            try {
                $dbResult = mysqli_query($this->dbConnection, $queryToRun);
                    return $dbResult;
            } 
            catch(Exception $ex){
            }
        }
    }

    public function getLastInsertId(){
        if($this->dbConnection != null) {
            return $this->dbConnection->insert_id;
        } else {
        }
        return null;
    }

    protected function __construct(){
        $this->dbConnection = null;
    }
}
?>
