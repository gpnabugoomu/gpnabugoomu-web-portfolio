<?php
require_once 'db.php';
// Fetch all episodes from database
$stmt = $pdo->query("SELECT * FROM episodes ORDER BY created_at DESC");
$db_episodes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gideon Speaks — Simple Podcast Hub</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header class="site-header">
    <div class="container">
      <div class="header-content">
        <div class="brand animate-fade-in">
          <span class="brand-icon">🎙️</span>
          <h1>Gideon Speaks</h1>
        </div>
        <nav class="header-nav">
          <a href="index.php" class="active">Home</a>
          <a href="rss.php" class="rss-link">RSS Feed</a>
          <a href="login.php">Admin</a>
        </nav>
      </div>
    </div>
  </header>

  <main>
    <section class="hero-home">
      <div class="hero-content container">
        <div class="hero-text animate-fade-in">
          <span class="pill">New Podcast</span>
          <h2>Your Daily Dose of <span class="accent">Perspective</span>.</h2>
          <p>Exploring the intersection of technology, minimalism, and intentional living.</p>
          <div class="hero-actions">
            <a href="#episodes" class="btn-primary">Browse Episodes</a>
          </div>
        </div>
        <div class="hero-image animate-fade-in">
          <img src="https://images.unsplash.com/photo-1590602847861-f357a9332bbc?q=80&w=1000&auto=format&fit=crop" alt="Podcast Microphone" class="floating">
        </div>
      </div>
    </section>

    <section id="episodes" class="container featured-section animate-fade-in">
      <div class="section-header">
        <h3>Latest Episodes</h3>
      </div>
      <div class="episodes-grid">
        <?php foreach($db_episodes as $index => $ep): ?>
        <article class="episode-card" style="animation: fadeInUp 0.6s ease-out forwards <?php echo $index * 0.1; ?>s; opacity: 1;">
          <div class="episode-image">
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800" alt="Thumbnail">
          </div>
          <div class="episode-content">
            <div class="episode-meta">
              <span class="tag">Podcast</span>
              <span class="date"><?php echo date('M d, Y', strtotime($ep['created_at'])); ?></span>
            </div>
            <h3 class="episode-title"><?php echo htmlspecialchars($ep['title']); ?></h3>
            <p class="episode-desc"><?php echo htmlspecialchars($ep['description']); ?></p>
            <button class="btn-play-inline" 
                    onclick="playAudio('<?php echo htmlspecialchars($ep['audio_url']); ?>', '<?php echo htmlspecialchars($ep['title']); ?>')">
              Listen Now
            </button>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </section>
  </main>

  <footer class="player-bar" id="playerBar">
    <div class="container player-inner">
      <div class="now-playing">
        <div class="track-info">
          <div class="track-title" id="currentTrackTitle">Select an episode</div>
          <div class="track-subtitle" id="currentTrackCategory">Podcast</div>
        </div>
      </div>
      <div class="player-controls">
        <audio id="mainAudio" controls style="width: 100%; filter: invert(1); height: 30px;"></audio>
      </div>
    </div>
  </footer>

  <script>
    function playAudio(url, title) {
      const audio = document.getElementById('mainAudio');
      const titleDisplay = document.getElementById('currentTrackTitle');
      
      // If the URL in the dashboard was "audio/file.mp3", ensure path is correct
      audio.src = url;
      titleDisplay.textContent = title;
      audio.play();
    }
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>

  <footer class="site-footer">
    <div class="container">
      <p>© <span id="year"></span> Gideon Speaks. Built for accessibility.</p>
    </div>
  </footer>
</body>
</html>