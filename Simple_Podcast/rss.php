<?php
/**
 * RSS Feed Generator for Gideon Speaks Podcast
 * Generates a valid RSS 2.0 feed with iTunes tags.
 */

// 1. Set the content type to XML
header('Content-Type: application/rss+xml; charset=utf-8');

require_once 'db.php';

// Dynamically determine the base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$baseUrl = $protocol . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

// 3. Fetch episodes from database
$stmt = $pdo->query("SELECT * FROM episodes ORDER BY created_at DESC");
$episodes = $stmt->fetchAll();

// 4. Generate XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss version="2.0" 
     xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" 
     xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>Gideon Speaks</title>
    <link><?php echo htmlspecialchars($baseUrl); ?></link>
    <language>en-us</language>
    <copyright>&#169; <?php echo date("Y"); ?> Gideon</copyright>
    <itunes:author>Gideon</itunes:author>
    <description>A minimalist audio streaming platform exploring tech, life, and productivity.</description>
    <itunes:type>episodic</itunes:type>
    <itunes:image href="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&amp;fit=crop&amp;q=80&amp;w=1400" />
    <itunes:category text="Technology" />
    <itunes:explicit>no</itunes:explicit>

    <?php foreach ($episodes as $ep): ?>
    <item>
      <itunes:episodeType>full</itunes:episodeType>
      <title><?php echo htmlspecialchars($ep['title']); ?></title>
      <description><?php echo htmlspecialchars($ep['description']); ?></description>
      <link><?php echo htmlspecialchars($baseUrl); ?>/episode.php?id=<?php echo $ep['id']; ?></link>
      <enclosure 
        url="<?php echo htmlspecialchars($ep['audio_url']); ?>" 
        length="0" 
        type="audio/mpeg" 
      />
      <guid isPermaLink="false"><?php echo $ep['id']; ?></guid>
      <pubDate><?php echo date(DATE_RSS, strtotime($ep['created_at'])); ?></pubDate>
      <itunes:duration><?php echo $ep['duration'] ?? '00:00:00'; ?></itunes:duration>
      <itunes:explicit>no</itunes:explicit>
    </item>
    <?php endforeach; ?>

  </channel>
</rss>