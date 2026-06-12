<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Gideon Speaks</title>
    <style>
        body { font-family: sans-serif; background: #070A12; color: #fff; display: grid; place-items: center; height: 100vh; margin: 0; }
        .card { background: rgba(255,255,255,0.05); padding: 2rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 6px; border: none; box-sizing: border-box;}
        button { width: 100%; padding: 10px; background: #7C6CFF; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Admin Login</h2>
        <?php if($error): ?><p style="color: #FFB86B;"><?= $error ?></p><?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p style="font-size: 0.8rem; margin-top: 15px;"><a href="signup.php" style="color: #53F3B3; text-decoration: none;">New setup?</a></p>
    </div>
</body>
</html>