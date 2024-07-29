<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once 'config.php';

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

    $sql = "UPDATE employees SET empid = ?, nic = ?, fname = ?, lname = ?, address = ?, gender = ?, phone = ?, position = ?, salary = ? WHERE empid = ?";
    $stmt = $conn->prepare($sql);

    try {
        if ($stmt->execute([$empid, $nic, $fname, $lname, $address, $gender, $phone, $position, $salary, $empid])) {
            $success = "Employee updated successfully!";
        } else {
            $error = "Error: Unable to update employee.";
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

if (isset($_GET['empid'])) {
    $empid = $_GET['empid'];
    $sql = "SELECT * FROM employees WHERE empid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$empid]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: view_employees.php");
    exit();
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/3.jpg'); /* Optional: Add a background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .alert {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-0">Edit Employee</h2>

        <form action="edit_employee.php" method="post">
            <input type="hidden" name="empid" value="<?php echo htmlspecialchars($employee['empid']); ?>">
            <div class="form-group">
                <label for="nic">Employee NIC</label>
                <input type="text" id="nic" name="nic" class="form-control" value="<?php echo htmlspecialchars($employee['nic']); ?>" required>
            </div>
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" class="form-control" value="<?php echo htmlspecialchars($employee['fname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" class="form-control" value="<?php echo htmlspecialchars($employee['lname']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($employee['address']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="Male" <?php echo $employee['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $employee['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo $employee['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($employee['phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" id="position" name="position" class="form-control" value="<?php echo htmlspecialchars($employee['position']); ?>" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" step="0.01" id="salary" name="salary" class="form-control" value="<?php echo htmlspecialchars($employee['salary']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Employee</button>
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
