<?php
class Employee {
    private $conn;
    private $table_name = "employees";

    public $empid;
    public $nic;
    public $fname;
    public $lname;
    public $address;
    public $gender;
    public $phone;
    public $position;
    public $salary;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (fname, lname, address,gender, phone, position, salary) VALUES (:fname, :lname, :address,:gender, :phone, :position, :salary)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':empid', $this->empid);
        $stmt->bindParam(':nic', $this->nic);
        $stmt->bindParam(':fname', $this->fname);
        $stmt->bindParam(':lname', $this->lname);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':salary', $this->salary);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
