<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once 'config.php';

$database = new Database();
$conn = $database->getConnection();

$searchId = isset($_GET['searchId']) ? $_GET['searchId'] : '';

if ($searchId != '') {
    $sql = "SELECT * FROM employees WHERE empid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$searchId]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM employees";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/10.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 100%;
        }
        .btn-back {
            margin-top: 1rem;
            width: 115%;
        }
        .btn-action {
            margin-right: 0.15rem;
            width: 100px;
        }
        .search-form {
            margin-bottom: 1.5rem;
            width: 115%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Employee List</h1>
        
        <form class="search-form" method="GET" action="">
            <div class="form-group">
                <input type="text" name="searchId" class="form-control" placeholder="Enter Employee ID" value="<?php echo htmlspecialchars($searchId); ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Search</button>
        </form>
        
        <?php if (count($result) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>NIC</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['empid']); ?></td>
                            <td><?php echo htmlspecialchars($row['nic']); ?></td>
                            <td><?php echo htmlspecialchars($row['fname']); ?></td>
                            <td><?php echo htmlspecialchars($row['lname']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['position']); ?></td>
                            <td><?php echo htmlspecialchars($row['salary']); ?></td>
                            <td>
                                <a href="edit_employee.php?empid=<?php echo $row['empid']; ?>" class="btn btn-warning btn-action">Edit</a>
                                <a href="delete_employee.php?empid=<?php echo $row['empid']; ?>" class="btn btn-danger btn-action" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No employees found.</p>
        <?php endif; ?>
        <a href="dashboard.php" class="btn btn-secondary btn-block btn-back">Back to Dashboard</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
