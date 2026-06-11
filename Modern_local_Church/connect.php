<?php
require __DIR__ . '/lib/db.php';
$pageTitle = "Connect Card - Gideon’s Church";

$notice = '';
$isError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $message = trim($_POST['message'] ?? '');

  if ($name === '' || $email === '' || $phone === '' || $message === '') {
    $isError = true;
    $notice = 'Please fill in all required fields.';
  } else {
    $conn = db();
    $stmt = $conn->prepare('INSERT INTO connect_cards (name, email, phone, message) VALUES (?,?,?,?)');
    if ($stmt) {
      $stmt->bind_param('ssss', $name, $email, $phone, $message);
      $stmt->execute();
      $notice = 'Thank you! Your Connect Card was submitted successfully.';
    } else {
      $isError = true;
      $notice = 'Database error while saving your card.';
    }
  }
}

require __DIR__ . '/includes/header.php';
?>

<section>
  <div class="sectionTitle">
    <h2>Connect Card</h2>
    <span>Digital visitor card (saved to MySQL)</span>
  </div>

  <?php if ($notice): ?>
    <div class="<?= $isError ? 'error' : 'notice' ?>" role="status" aria-live="polite">
      <?= htmlspecialchars($notice) ?>
    </div>
  <?php endif; ?>

  <div class="panel" style="margin-top:14px">
    <form id="connectForm" method="post" action="/connect.php" aria-label="Connect Card form">
      <div class="formRow">
        <div class="field">
          <label for="name">Full Name *</label>
          <input id="name" name="name" type="text" autocomplete="name" />
        </div>
        <div class="field">
          <label for="email">Email *</label>
          <input id="email" name="email" type="email" autocomplete="email" />
        </div>
        <div class="field">
          <label for="phone">Phone *</label>
          <input id="phone" name="phone" type="tel" autocomplete="tel" />
        </div>
        <div class="field full">
          <label for="message">Message *</label>
          <textarea id="message" name="message" placeholder="Tell us what you need or what brings you to Gideon’s Church..."></textarea>
        </div>
        <div class="field full">
          <div id="formError" class="error hidden" style="margin-bottom:12px">All fields marked with * are required.</div>
          <button class="button primary" type="submit">Submit Connect Card</button>
          <a class="button" style="margin-left:10px" href="/location.php">Service Times</a>
        </div>
      </div>
    </form>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

