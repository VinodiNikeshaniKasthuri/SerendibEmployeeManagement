<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
            
        }
        .btn {
            font-size: 1.5rem;
            padding: 1rem;
            margin: 1rem 0;
        
        }
        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .calendar-container {
            margin-left: 2rem;
            max-width: 300px;
            width: 100%;
        }
        .calendar-container iframe {
            border: none;
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <h1 style="font-family: 'Times New Roman', serif; font-weight: bold; text-align: center;">Welcome!</h1>
            <h2 style="font-family: 'Times New Roman', serif; font-weight: bold; text-align: center;">Admin</h2>
            
            
            <a href="add_employee.php" class="btn btn-primary btn-block" style="background-color:#158caf; border-color: #ff5733;">Employee Registration</a>

            <a href="view_employees.php" class="btn btn-primary btn-block" style="background-color:  #1c973c; border-color: #ff5733;">View Employee List</a>
            <a href="index.html" class="btn btn-primary btn-block" style="background-color: #d23e27; border-color: #ff5733;">Logout</a>
        </div>
       
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
