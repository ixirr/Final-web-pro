<?php
include 'config.php';
requireLogin();

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $topic = trim($_POST['topic']);
    $details = trim($_POST['details']);
    
    if (empty($topic) || empty($details)) {
        $message = "⚠️ Please fill in all required fields.";
        $messageType = 'error';
    } else {
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO service_requests (user_id, service_type, topic, details) 
                VALUES ('$user_id', 'programming', '$topic', '$details')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "✅ Your programming help request has been submitted successfully!";
            $messageType = 'success';
        } else {
            $message = "❌ Error: " . mysqli_error($conn);
            $messageType = 'error';
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<section>
    <h2>💻 Programming Help Service</h2>
    <p>Need help with your code or project? Submit your request below.</p>
    
    <form method="POST">
        <label for="topic">Programming Language</label>
        <input type="text" id="topic" name="topic" placeholder="e.g., Python, Java, C++..." required>

        <label for="details">Describe Your Issue</label>
        <textarea id="details" name="details" placeholder="Explain what you need help with..." rows="6" required></textarea>
        
        <?php if ($message): ?>
            <div class="form-message <?php echo $messageType; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <button type="submit" class="btn">Submit Request</button>
    </form>
    
    <p>
        <a href="dashboard.php">← Back to Dashboard</a>
    </p>
</section>


<?php include 'includes/footer.php'; ?>

