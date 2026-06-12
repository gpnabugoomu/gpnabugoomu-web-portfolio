<?php 
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);
            $success = "Registration successful! You can now login.";
        } catch (PDOException $e) {
            $error = "Username or email already exists.";
        }
    }
}
include 'header.php'; 
?>

<main class="section-padded">
  <div class="container">
    <div style="max-width: 400px; margin: 0 auto; background: var(--panel); padding: 30px; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.1);">
      <h2 class="section-title">Join Fellowship</h2>
      <p class="section-subtitle" style="margin-bottom: 20px;">Create your account today.</p>

      <?php if ($error): ?><p style="color: var(--brand-3); margin-bottom: 15px;"><?= $error ?></p><?php endif; ?>
      <?php if ($success): ?><p style="color: var(--brand); margin-bottom: 15px;"><?= $success ?></p><?php endif; ?>

      <form method="POST">
        <div style="margin-bottom: 15px;">
          <input type="text" name="username" placeholder="Username" required style="width: 100%; padding: 12px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: white;">
        </div>
        <div style="margin-bottom: 15px;">
          <input type="email" name="email" placeholder="Email Address" required style="width: 100%; padding: 12px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: white;">
        </div>
        <div style="margin-bottom: 20px;">
          <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: white;">
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Create Account</button>
      </form>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>