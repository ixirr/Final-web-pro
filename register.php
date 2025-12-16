<?php
include 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirmPassword'];

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        $error = "Please fill in all fields.";
    }
    elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    }
    elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } 
    else {
        // Check if email exists
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        
        if (mysqli_num_rows($check) > 0) {
            $error = "Email is already registered.";
        } 
        else {
            // Hash password using MD5
            $hashed_password = md5($password);

            $sql = "INSERT INTO users (name, email, password) 
                    VALUES ('$name', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {
                $success = "Account created! Redirecting...";
                echo "<script>
                        setTimeout(function() { 
                            window.location.href = 'login.php'; 
                        }, 1500);
                      </script>";
            } else {
                $error = "Something went wrong.";
            }
        }
    }
}
?>


<?php include 'includes/header.php'; ?>

<section>
    <h2>Create Your Account 🚀</h2>
    <p>Join UniHub and start exploring student services!</p>
    
    <form method="POST" id="registerForm">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>


        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>


        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required>
        <div class="password-strength">
            <div class="strength-bar"></div>
            <span class="strength-text">Enter a password</span>
        </div>
        <br>
        <p>Password must be at least 6 characters</p>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
        
        <?php if ($error): ?>
            <div class="message-box error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="message-box success-message"><?php echo $success; ?></div>
        <?php endif; ?>
       
        <button type="submit" class="btn">Sign Up</button>
        
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
</section>

<script>
const passwordInput = document.getElementById('password');
const strengthBar = document.querySelector('.strength-bar');
const strengthText = document.querySelector('.strength-text');

if (passwordInput && strengthBar && strengthText) {
    passwordInput.addEventListener('input', function() {
        const value = this.value;
        let strength = 0;
        
        if (value.length >= 6) strength++;
        if (value.length >= 8) strength++;
        if (/[A-Z]/.test(value)) strength++;
        if (/[0-9]/.test(value)) strength++;
        
        if (strength === 0) {
            strengthBar.style.width = "0%";
            strengthBar.style.backgroundColor = "gray";
            strengthText.textContent = "Very Weak";
        } else if (strength === 1) {
            strengthBar.style.width = "25%";
            strengthBar.style.backgroundColor = "red";
            strengthText.textContent = "Weak";
        } else if (strength === 2) {
            strengthBar.style.width = "50%";
            strengthBar.style.backgroundColor = "orange";
            strengthText.textContent = "Fair";
        } else if (strength === 3) {
            strengthBar.style.width = "75%";
            strengthBar.style.backgroundColor = "yellow";
            strengthText.textContent = "Good";
        } else if (strength === 4) {
            strengthBar.style.width = "100%";
            strengthBar.style.backgroundColor = "green";
            strengthText.textContent = "Strong!";
        }
    });
}
</script>

<?php include 'includes/footer.php'; ?>