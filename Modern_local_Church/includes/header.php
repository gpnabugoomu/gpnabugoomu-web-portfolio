<?php
// $pageTitle, $activePage (optional) can be set by each page.
$pageTitle = $pageTitle ?? "Gideon's Church";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
  <div class="topbar">
    <div class="container">
      <nav class="nav" aria-label="Primary">
        <a class="brand" href="/index.php" aria-label="Gideon's Church Home">
          <span class="logo" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 3l9 5v8c0 1.7-1.2 3.2-2.9 3.7L12 22l-6.1-2.3C4.2 19.2 3 17.7 3 16V8l9-5z" stroke="white" stroke-width="1.8"/>
              <path d="M9.5 12.5l1.8 1.8L15.8 9.8" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span>Gideon’s Church</span>
        </a>

        <div class="navlinks">
          <a data-nav href="/index.php">Home</a>
          <a data-nav href="/sermons.php">Sermons</a>
          <a data-nav href="/ministries.php">Ministries</a>
          <a data-nav href="/connect.php">Connect Card</a>
          <a data-nav href="/location.php">Location & Times</a>
        </div>

        <div class="cta">
          <a class="button primary" href="/connect.php">Visit Us</a>
        </div>
      </nav>
    </div>
  </div>

  <main>
    <div class="container">
