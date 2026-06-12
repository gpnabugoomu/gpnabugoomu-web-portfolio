<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Christian Fellowship</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header">
  <div class="container header-content">
    <a href="index.php" class="brand">
      <div class="brand-icon">⛪</div>
      <h1>Fellowship</h1>
    </a>
    <nav class="main-nav">
      <a href="index.php" class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a>
      <a href="about.php" class="nav-link <?= $current_page == 'about.php' ? 'active' : '' ?>">About</a>
      <a href="prayer_wall.php" class="nav-link <?= $current_page == 'prayer_wall.php' ? 'active' : '' ?>">Prayer Wall</a>
      <a href="small_groups.php" class="nav-link <?= $current_page == 'small_groups.php' ? 'active' : '' ?>">Small Groups</a>
      <a href="event_calendar.php" class="nav-link <?= $current_page == 'event_calendar.php' ? 'active' : '' ?>">Events</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="nav-link" style="color: var(--brand);">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
        <a href="logout.php" class="btn btn-secondary">Logout</a>
      <?php else: ?>
      <a href="login.php" class="btn btn-secondary">Login</a>
      <a href="register.php" class="btn btn-primary">Register</a>
      <?php endif; ?>
    </nav>
    <button class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
</header>