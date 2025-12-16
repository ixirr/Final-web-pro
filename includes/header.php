<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniHub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <h1 class="logo">UniHub</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="services.php">Services</a>
            <?php if (isLoggedIn()): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Sign Up</a>
            <?php endif; ?>
        </nav>
</header>
