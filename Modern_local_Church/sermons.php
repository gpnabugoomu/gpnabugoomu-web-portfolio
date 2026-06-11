<?php
require __DIR__ . '/lib/db.php';
$pageTitle = "Sermons - Gideon’s Church";

$pdo = db();

// Filters
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';
$speaker = isset($_GET['speaker']) ? trim($_GET['speaker']) : '';
$topic = isset($_GET['topic']) ? trim($_GET['topic']) : '';

$where = [];
$types = '';
$params = [];

if ($from !== '') { $where[] = 'sermon_date >= ?'; $types .= 's'; $params[] = $from; }
if ($to !== '') { $where[] = 'sermon_date <= ?'; $types .= 's'; $params[] = $to; }
if ($speaker !== '') { $where[] = 'speaker LIKE ?'; $types .= 's'; $params[] = '%' . $speaker . '%'; }
if ($topic !== '') { $where[] = 'topic LIKE ?'; $types .= 's'; $params[] = '%' . $topic . '%'; }

$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$sql = "SELECT sermon_date, speaker, topic, title, audio_url, video_url
        FROM sermons
        $whereSql
        ORDER BY sermon_date DESC
        LIMIT 60";

$stmt = $pdo->prepare($sql);
if ($stmt) {
  if ($types !== '') {
    $stmt->bind_param($types, ...$params);
  }
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  $result = null;
}

$rows = [];
if ($result) {
  while($r = $result->fetch_assoc()) $rows[] = $r;
}

require __DIR__ . '/includes/header.php';
?>

<section>
  <div class="sectionTitle">
    <h2>Sermon Archive</h2>
    <span>Filter by date, speaker, or topic</span>
  </div>

  <div class="toolbar">
    <form class="filters" method="get" action="/sermons.php" aria-label="Sermon filters">
      <div class="pill">
        <label for="from">From</label>
        <input id="from" name="from" type="date" value="<?= htmlspecialchars($from) ?>" />
      </div>
      <div class="pill">
        <label for="to">To</label>
        <input id="to" name="to" type="date" value="<?= htmlspecialchars($to) ?>" />
      </div>
      <div class="pill">
        <label for="speaker">Speaker</label>
        <input id="speaker" name="speaker" type="text" placeholder="e.g. Pastor" value="<?= htmlspecialchars($speaker) ?>" />
      </div>
      <div class="pill">
        <label for="topic">Topic</label>
        <input id="topic" name="topic" type="text" placeholder="e.g. Faith" value="<?= htmlspecialchars($topic) ?>" />
      </div>
      <button class="button primary" type="submit">Search</button>
      <a class="button" href="/sermons.php">Reset</a>
    </form>
  </div>

  <table class="table" aria-label="Sermons list">
    <thead>
      <tr>
        <th style="width: 120px">Date</th>
        <th>Title</th>
        <th style="width: 160px">Speaker</th>
        <th style="width: 170px">Topic</th>
        <th style="width: 170px">Media</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!$rows): ?>
        <tr><td colspan="5">No sermons found. Add rows to `sermons` table.</td></tr>
      <?php else: ?>
        <?php foreach($rows as $row): ?>
          <tr>
            <td><?= htmlspecialchars($row['sermon_date']) ?></td>
            <td>
              <div style="font-weight:750; color:rgba(234,240,255,.95)" ><?= htmlspecialchars($row['title']) ?></div>
            </td>
            <td><?= htmlspecialchars($row['speaker']) ?></td>
            <td><?= htmlspecialchars($row['topic']) ?></td>
            <td>
              <?php if (!empty($row['video_url']) || !empty($row['audio_url'])): ?>
                <div class="row" style="gap:8px">
                  <?php if (!empty($row['video_url'])): ?>
                    <a class="button" style="padding:9px 10px" href="<?= htmlspecialchars($row['video_url']) ?>" target="_blank" rel="noopener">Video</a>
                  <?php endif; ?>
                  <?php if (!empty($row['audio_url'])): ?>
                    <a class="button" style="padding:9px 10px" href="<?= htmlspecialchars($row['audio_url']) ?>" target="_blank" rel="noopener">Audio</a>
                  <?php endif; ?>
                </div>
              <?php else: ?>
                <span class="muted">No media</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

