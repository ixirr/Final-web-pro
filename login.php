/* <?php
include 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error = "⚠️ Please fill in all fields.";
    } else {

        // Hash the password using MD5
        $hashed_password = md5($password);

        // Query user with email + hashed password
        $query = "SELECT * FROM users WHERE email='$email' AND password='$hashed_password'";
        $result = mysqli_query($conn, $query);        
        
        if (mysqli_num_rows($result) == 1) {           
            $user = mysqli_fetch_assoc($result);
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header('Location: dashboard.php');
            exit();
        } 
        else {
            $error = "❌ Incorrect email or password.";
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<section>
    <h2>Welcome Back 👋</h2>
    <p>Please log in to your UniHub account</p>
    
    <form method="POST" action="">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
        <?php if (!empty($error)): ?>
            <div class="message-box error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <button type="submit" class="btn">Login</button>
        
        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
