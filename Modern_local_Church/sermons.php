<?php 
$customPageTitle = "Sermons";
include 'header.php';

// Fetch sermons from database
$stmt = $pdo->query("SELECT * FROM sermons ORDER BY sermon_date DESC");
$sermons = $stmt->fetchAll();
?>

<main class="container page-content">
    <div class="page-header">
        <h2>Sermon Archive</h2>
        <p>Explore our library of teachings and series.</p>
    </div>

    <div class="sermon-grid">
        <?php foreach ($sermons as $sermon): ?>
        <div class="sermon-card">
            <div class="sermon-meta">
                <span><?= date('M d, Y', strtotime($sermon['sermon_date'])) ?></span>
                <span><?= htmlspecialchars($sermon['speaker']) ?></span>
            </div>
            <h3><?= htmlspecialchars($sermon['title']) ?></h3>
            <p><?= htmlspecialchars($sermon['series']) ?></p>
            <a href="<?= htmlspecialchars($sermon['video_url']) ?>" class="watch-link">Watch Message →</a>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'footer.php'; ?>