<?php
include 'config.php';
requireLogin();
?>
<?php include 'includes/header.php'; ?>

<section>
    <h2>Welcome, <?php echo $_SESSION['user_name']; ?> 👋</h2>
    <p>You are now logged in to UniHub!</p>
    <a href="services.php" class="btn">Go to Services</a>
</section>

<?php include 'includes/footer.php'; ?>