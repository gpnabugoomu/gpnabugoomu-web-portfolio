<?php 
session_start();
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
include 'header.php'; 
?>

<main class="section-padded">
  <div class="container">
    <div style="max-width: 400px; margin: 0 auto; background: var(--panel); padding: 30px; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.1);">
      <h2 class="section-title">Welcome Back</h2>
      <p class="section-subtitle" style="margin-bottom: 20px;">Login to your account.</p>

      <?php if ($error): ?><p style="color: var(--brand-3); margin-bottom: 15px;"><?= $error ?></p><?php endif; ?>

      <form method="POST">
        <div style="margin-bottom: 15px;">
          <input type="email" name="email" placeholder="Email Address" required style="width: 100%; padding: 12px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: white;">
        </div>
        <div style="margin-bottom: 20px;">
          <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.1); background: rgba(0,0,0,0.2); color: white;">
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
      </form>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>