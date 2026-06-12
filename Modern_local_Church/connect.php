<?php 
$customPageTitle = "Connect";
include 'header.php';

// Handle form submission
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO connect_cards (full_name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['message']]);
    $success = true;
}
?>

<main class="container page-content">
    <div class="form-container">
        <h2>Get Connected</h2>
        <p>We'd love to meet you! Fill out this card to stay in the loop.</p>

        <?php if ($success): ?>
            <div class="alert success">Thank you! We will reach out to you shortly.</div>
        <?php endif; ?>

        <form method="POST" class="connect-form">
            <div class="input-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label>How can we support you?</label>
                <textarea name="message" rows="4"></textarea>
            </div>
            <button type="submit" class="btn-primary">Submit Card</button>
        </form>
    </div>
</main>
<?php include 'footer.php'; ?>