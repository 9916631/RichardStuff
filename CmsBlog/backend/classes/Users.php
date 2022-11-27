<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Users{
    protected $db;
    
    public function __construct(){
        $this->db = Database::instance();
    }
    
    public function emailExist($email){
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `email` = :email");
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function hash($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    public function isLoggedIn(){
        return ((isset($_SESSION['user_id'])) ? true : false);
    }
    
    public function ID(){
        if($this->isLoggedIn()){
            return $_SESSION['user_id'];
        }
    }
    
    public function userData($user_id = null){
        $user_id = (($user_id === null) ? $this->ID() : $user_id);
        $stmt = $this->db->prepare("SELECT * FROM `users` WHERE `userID` = :userID");
        $stmt->bindParam(":userID", $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
        
    }
    
    public function get($table, $fields = array()){
        $where = " WHERE ";
        $sql = "SELECT * FROM `{$table}`";
        
        //the key is key for the index key / colum in the table primary key. blogID in this case
        //so that each user gets their own blog displaying on the same server 
        foreach($fields as $key => $value){
            $sql .= "{$where} `{$key}` = :{$key}";
        }
        //make it go to the blogID coloum in blog table also the value or id of the blog
        //so blogID 1 or key valueas below
        if($stmt = $this->db->prepare($sql)){
            foreach($fields as $key => $value){
                $stmt->bindValue(":{$key}", $value);
            }
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
    
    public function create($table, $fields = array()){
        $columns = implode(", ", array_keys($fields));
        $values = ":".implode(", :", array_keys($fields));
 
        $sql = "INSERT INTO {$table} ({$columns}) VALUES()";
        var_dump($sql);
        /*
        if($stmt = $this->db->prepare($sql)){
            foreach($fields as $key => $value){
                $stmt->bindValue(":{$key}", $value);
            }
            $stmt->execute();
              return $this->db->lastInsertId();
              //    
        }*/
        
    }
}
?>