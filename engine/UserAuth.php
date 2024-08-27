<?php 


class UserAuth {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->conn;
    }

    public function register($name,$email,$password,$verified,$date,$vkey) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user_profile (name,email,password,verified,date,vkey) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssss", $name,$email,$hash_password,$verified,$date,$vkey);
        return $stmt->execute();
        
    }

    public function login($email, $password) {
      $sql = "SELECT id, email, password FROM user_profile WHERE email = ? AND verified = 1";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception("Failed to prepare SQL statement.");
        }
    
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
    
 
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $db_email, $hashed_password);
            $stmt->fetch();
    
         
            if (password_verify($password, $hashed_password)) {
            
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $db_email;
           
                return true;
            } else {
              
                return false;
            }
        } else {
       
            return false;
        }
    }


    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}
