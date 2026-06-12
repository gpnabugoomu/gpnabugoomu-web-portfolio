<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'db.php';

$msg = '';

// Handle New Episode Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_episode'])) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $duration = $_POST['duration'];
    
    // Simple File Handling
    $target_dir = "../audio/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
    
    $file_name = basename($_FILES["audio_file"]["name"]);
    $target_file = $target_dir . $file_name;
    $audio_url = "audio/" . $file_name;

    if (move_uploaded_file($_FILES["audio_file"]["tmp_name"], $target_file)) {
        $stmt = $pdo->prepare("INSERT INTO episodes (title, description, audio_url, duration) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $desc, $audio_url, $duration]);
        $msg = "Episode uploaded successfully!";
    } else {
        $msg = "Error uploading file.";
    }
}

// Fetch episodes
$episodes = $pdo->query("SELECT * FROM episodes ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Gideon Speaks</title>
    <style>
        body { font-family: sans-serif; background: #070A12; color: #fff; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 30px;}
        .form-section { background: rgba(255,255,255,0.05); padding: 20px; border-radius: 12px; margin-bottom: 30px; }
        input, textarea { width: 100%; padding: 10px; margin: 8px 0; border-radius: 6px; border: 1px solid #444; background: #111; color: #fff; box-sizing: border-box;}
        button { padding: 10px 20px; background: #53F3B3; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #222; }
        .logout { color: #FFB86B; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Podcast Dashboard</h1>
            <a href="logout.php" class="logout">Logout</a>
        </header>

        <?php if($msg): ?><p style="background: rgba(83,243,179,0.1); padding: 10px; border-radius: 6px; color: #53F3B3;"><?= $msg ?></p><?php endif; ?>

        <div class="form-section">
            <h3>Upload New Episode</h3>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Episode Title" required>
                <textarea name="description" placeholder="Description" rows="3" required></textarea>
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="duration" placeholder="Duration (e.g. 12:45)" style="flex: 1;">
                    <input type="file" name="audio_file" accept="audio/*" required style="flex: 2;">
                </div>
                <button type="submit" name="add_episode">Publish Episode</button>
            </form>
        </div>

        <h3>Existing Episodes</h3>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Audio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($episodes as $ep): ?>
                <tr>
                    <td><?= date('M d, Y', strtotime($ep['created_at'])) ?></td>
                    <td><?= htmlspecialchars($ep['title']) ?></td>
                    <td><?= htmlspecialchars($ep['duration']) ?></td>
                    <td><a href="../<?= $ep['audio_url'] ?>" target="_blank" style="color: #7C6CFF;">Play</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>