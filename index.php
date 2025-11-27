<?php
require_once 'UserController.php';

$userController = new UserController();

if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $userController->loginAction();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome to our Event Management Platform</h1>
        <p>Log in to access the events</p>
        <a href="login.php" class="btn">Log in</a>
    </div>
</body>
</html>

