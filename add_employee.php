<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';


$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empid = $_POST['empid'];
    $nic = $_POST['nic'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $gender = $_POST['gender']; 
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    

    
    $sql = "INSERT INTO employees (empid, nic, fname, lname, address, phone, position, salary, gender) VALUES (:empid, :nic, :fname, :lname, :address, :phone, :position, :salary, :gender)";
    $stmt = $conn->prepare($sql);

    
    $stmt->bindParam(':empid', $empid);
    $stmt->bindParam(':nic', $nic);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':gender', $gender); // Bind gender
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':salary', $salary);
    

    try {
        if ($stmt->execute()) {
            $success = "New employee added successfully!";
        } else {
            $error = "Error: Unable to add employee.";
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

$conn = null; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/3.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .btn-submit {
            margin-top: 1rem;
        }
        .alert {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row ">
        <div class="col-md-12 text-center p-0" style="background-image:url('images/3.jpg');">
            <p class="text-uppercase p-5 m-auto text-black font-weight-lighter" style=" font-family: 'Times New Roman',serif; font-size: 3vw;"> </p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
            <p class="text-uppercase p-3 m-auto text-black font-weight-lighter" style=" font-family: 'Times New Roman',serif; font-size: 3vw;"> Employee Registration</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                  </p>
        </div>
    </div>

        <form action="add_employee.php" method="post">
            <div class="form-group">
                <label for="empid">*Employee Id</label>
                <input type="text" id="empid" name="empid" class="form-control" placeholder="Employee Id" required>
            </div>
            <div class="form-group">
                <label for="nic">*NIC</label>
                <input type="text" id="nic" name="nic" class="form-control" placeholder="Employee NIC" required>
            </div>
            <div class="form-group">
                <label for="fname">*First Name</label>
                <input type="text" id="fname" name="fname" class="form-control" placeholder="Employee First Name" required>
            </div>
            <div class="form-group">
                <label for="lname">*Last Name</label>
                <input type="text" id="lname" name="lname" class="form-control" placeholder="Employee Last Name" required>
            </div>
            <div class="form-group">
                <label for="address">*Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Employee Address" required>
            </div>
            <div class="form-group">
                <label for="gender">*Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">*Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Employee Phone" required>
            </div>
            
            <div class="form-group">
                <label for="position">*Position</label>
                <input type="text" id="position" name="position" class="form-control" placeholder="Employee Position" required>
            </div>
            <div class="form-group">
                <label for="salary">*Salary</label>
                <input type="number" step="0.01" id="salary" name="salary" class="form-control" placeholder="Employee Salary" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-submit btn-block">Add Employee</button>
            <a href="view_employees.php" class="btn btn-primary btn-block">View All Employees</a>

            <?php if (isset($success)): ?>
                <div class="alert alert-success mt-3"><?php echo htmlspecialchars($success); ?></div>
            <?php elseif (isset($error)): ?>
                <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
