<?php 
require_once 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Handle new prayer post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $content = trim($_POST['content']);
    
    if ($title && $content) {
        $stmt = $pdo->prepare("INSERT INTO prayers (user_id, title, category, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $category, $content]);
    }
}

// Handle "Amen" / Praying Count increment
if (isset($_GET['pray_for'])) {
    $stmt = $pdo->prepare("UPDATE prayers SET praying_count = praying_count + 1 WHERE id = ?");
    $stmt->execute([$_GET['pray_for']]);
    header("Location: prayer_wall.php");
    exit;
}

// Fetch all prayers
$prayers = $pdo->query("SELECT p.*, u.username FROM prayers p LEFT JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC")->fetchAll();
include 'header.php'; 
?>

<main class="section-padded">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Prayer Wall</h2>
            <p class="section-subtitle">"Carry each other’s burdens, and in this way you will fulfill the law of Christ." — Galatians 6:2</p>
            
            <?php if (isset($_SESSION['user_id'])): ?>
            <div style="max-width: 600px; margin: 30px auto; background: var(--panel); padding: 20px; border-radius: var(--radius-md); text-align: left;">
                <form method="POST">
                    <input type="text" name="title" placeholder="Request Title" required style="width: 100%; padding: 10px; margin-bottom: 10px; background: rgba(0,0,0,0.2); border: 1px solid #333; color: white;">
                    <input type="text" name="category" placeholder="Category (e.g. Healing, Family)" style="width: 100%; padding: 10px; margin-bottom: 10px; background: rgba(0,0,0,0.2); border: 1px solid #333; color: white;">
                    <textarea name="content" placeholder="How can we pray for you?" required style="width: 100%; padding: 10px; height: 80px; margin-bottom: 10px; background: rgba(0,0,0,0.2); border: 1px solid #333; color: white;"></textarea>
                    <button type="submit" class="btn btn-primary">Post Request</button>
                </form>
            </div>
            <?php else: ?>
            <p style="margin-top: 20px;"><a href="login.php" class="highlight">Login</a> to share a prayer request.</p>
            <?php endif; ?>
        </div>

        <div class="features-grid" style="margin-top: 40px;">
            <?php if (empty($prayers)): ?>
                <p class="text-center" style="grid-column: span 4; color: var(--muted);">No prayer requests yet. Be the first to share.</p>
            <?php else: ?>
                <?php foreach ($prayers as $prayer): ?>
            <div class="feature-card">
                <div class="hero-kicker"><?= htmlspecialchars($prayer['category']) ?></div>
                <h3><?= htmlspecialchars($prayer['title']) ?></h3>
                <p style="margin-bottom: 15px;"><?= nl2br(htmlspecialchars($prayer['content'])) ?></p>
                <p style="font-size: 0.8rem; color: var(--brand-2);">Posted by <?= htmlspecialchars($prayer['username'] ?? 'Anonymous') ?></p>
                <a href="?pray_for=<?= $prayer['id'] ?>" class="btn-link">Amen (<?= $prayer['praying_count'] ?>)</a>
            </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>