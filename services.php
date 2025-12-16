<?php
include 'config.php';
requireLogin();
?>
<?php include 'includes/header.php'; ?>

<section>
    <h3>Our Services</h3>
    <div class="cards">
        <article>
            <img src="img/ux.png" alt="Presentation Design">
            <h4>Presentation Design</h4>
            <p>Professional PowerPoint design for your university projects.</p>
            <a href="presentation.php" class="btn">View Service</a>
        </article>
        
        <article>
            <img src="img/languages.png" alt="Translation">
            <h4>Academic Translation</h4>
            <p>Fast and accurate translation for essays and research papers.</p>
            <a href="translation.php" class="btn">View Service</a>
        </article>
        
        <article>
            <img src="img/programming.png" alt="Programming Help">
            <h4>Programming Help</h4>
            <p>Student developers ready to help you with your coding tasks.</p>
            <a href="programming.php" class="btn">View Service</a>
        </article>
    </div>
</section>

<?php
// Get logged-in user ID
$user_id = $_SESSION['user_id'];

// Fetch service requests for this user
$sql = "SELECT * FROM service_requests WHERE user_id = $user_id ORDER BY created_at DESC";
$res = mysqli_query($conn, $sql);
?>
<section>
    <h3>Your Submitted Requests</h3>

    <?php if (mysqli_num_rows($res) > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Service Type</th>
                <th>Topic</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['service_type']; ?></td>
                    <td><?php echo $row['topic']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>You have not submitted any service requests yet.</p>
    <?php endif; ?>

</section>


<?php include 'includes/footer.php'; ?>