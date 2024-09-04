<?php
  session_start();
class UserAuth {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->conn;
       // Start the session at the beginning
    }

    public function register($name, $email, $password, $img_upload, $country, $whatsapp, $location, $facebook, $twitter, $linkedin, $instagram, $verified, $blacklist, $date, $vkey) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user_profile (name, email, password, img_upload, verified, country, whatsapp, location, facebook, twitter, linkedin, instagram, veriied, blacklist, date, vkey) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception("Failed to prepare SQL statement.");
        }

        $stmt->bind_param("ssssssssssssiiss", $name, $email, $hash_password, $img_upload, $country, $whatsapp, $location, $facebook, $twitter, $linkedin, $instagram, $verified, $blacklist, $date, $vkey);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }

    public function login($email, $password) {
        $sql = "SELECT id, name,img_upload, email, password FROM user_profile WHERE email = ? AND verified = 1 and blacklist = 0 ";
        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Failed to prepare SQL statement.");
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $name, $img_upload,$db_email, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $db_email;
                $_SESSION['name'] = $name;
                $_SESSION['img'] = $img_upload;
                
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            $stmt->close();
            return false;
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true); // Prevent session fixation attacks
            session_unset();
            session_destroy();
        }
    }
}
