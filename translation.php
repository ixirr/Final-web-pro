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
                VALUES ('$user_id', 'translation', '$topic', '$details')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "✅ Your translation request has been submitted successfully!";
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
    <h2>🌍 Academic Translation Service</h2>
    <p>Submit your text for quick and accurate translation.</p>
    
    <form method="POST">
        <label for="topic">Target Language</label>
        <input type="text" id="topic" name="topic" placeholder="e.g., English, Arabic..." required>

        <label for="details">Text to Translate</label>
        <textarea id="details" name="details" placeholder="Paste your text here..." rows="6" required></textarea>
        
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