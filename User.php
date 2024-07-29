<?php
class User {
    private $conn;
    private $table_name = "users";

    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($sql);

        
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        $stmt->execute();
        return $stmt;
    }
}
?>
