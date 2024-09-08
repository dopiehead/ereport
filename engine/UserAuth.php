<?php
  session_start();
class UserAuth {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db->conn;
       // Start the session at the beginning
    }

    public function register($name, $email, $password, $img_upload, $country, $whatsapp , $location, $facebook, $twitter, $linkedin, $instagram, $blacklist, $date, $verified, $vkey) {
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user_profile (name, email, password, img_upload, country, whatsapp, location, facebook, twitter, linkedin, instagram, blacklist, date, verified, vkey) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception("Failed to prepare SQL statement.");
        }

        $stmt->bind_param("sssssssssssiiss", $name, $email, $hash_password, $img_upload, $country, $whatsapp, $location, $facebook, $twitter, $linkedin, $instagram, $blacklist, $date, $verified, $vkey);
        $success = $stmt->execute();
        $stmt->close();
        
        return $success;
    }

    public function login($email, $password) {
        $sql = "SELECT id, name, email, password, img_upload, contact, location, blacklist, verified FROM user_profile WHERE email = ? AND verified = 1 and blacklist = 0 ";
        $stmt = $this->db->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Failed to prepare SQL statement.");
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $name, $email, $hashed_password, $img_upload, $contact, $location, $blacklist, $verified);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $name;
                $_SESSION['img'] = $img_upload;
                $_SESSION['location'] = $location;
                $_SESSION['contact'] = $contact;

                
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
