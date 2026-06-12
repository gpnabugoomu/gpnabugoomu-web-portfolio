<?php
require_once 'db.php';

// Check if an admin already exists
$stmt = $pdo->query("SELECT COUNT(*) FROM users");
if ($stmt->fetchColumn() > 0) {
    header("Location: login.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!empty($user) && !empty($_POST['password'])) {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$user, $pass])) {
            header("Location: login.php?msg=Admin created successfully");
            exit;
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Setup Admin - Gideon Speaks</title>
    <style>
        body { font-family: sans-serif; background: #070A12; color: #fff; display: grid; place-items: center; height: 100vh; margin: 0; }
        .card { background: rgba(255,255,255,0.05); padding: 2rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 6px; border: none; box-sizing: border-box;}
        button { width: 100%; padding: 10px; background: #53F3B3; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Initial Setup</h2>
        <p>Create the primary admin account.</p>
        <?php if($error): ?><p style="color: #FFB86B;"><?= $error ?></p><?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Create Admin</button>
        </form>
    </div>
</body>
</html>