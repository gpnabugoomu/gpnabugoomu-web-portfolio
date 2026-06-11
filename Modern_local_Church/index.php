<?php
$pageTitle = "Home - Gideon’s Church";
require __DIR__ . '/includes/header.php';
?>

<section class="hero">
  <div class="heroGrid">
    <div class="heroCard">
      <div class="kicker">Welcome</div>
      <h1 class="h1">A church family where faith grows, hope spreads, and people feel at home.</h1>
      <p class="lead">
        Explore sermons, discover ministries for every age, and connect with our team.
        Whether you’re a longtime member or visiting for the first time—come as you are.
      </p>
      <div class="row">
        <a class="button primary" href="/location.php">Service Times</a>
        <a class="button" href="/sermons.php">Latest Sermons</a>
      </div>
      <div class="badges" role="list" aria-label="Highlights">
        <div class="badge" role="listitem">Modern Worship</div>
        <div class="badge" role="listitem">Family Ministries</div>
        <div class="badge" role="listitem">Sermon Archive</div>
        <div class="badge" role="listitem">Connect Cards</div>
      </div>
    </div>

    <div class="sideStack">
      <div class="panel">
        <h3>Next Service</h3>
        <p>
          Sunday • 8:00 AM &amp; 10:00 AM<br/>
          <span class="muted">(Update these times in `location.php`)</span>
        </p>
      </div>
      <div class="panel">
        <h3>New Here?</h3>
        <p>
          Fill out a Connect Card so we can welcome you and help you find your place.
        </p>
        <div class="row" style="margin-top:12px">
          <a class="button" href="/connect.php">Open Connect Card</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="sectionTitle">
    <h2>What you can explore</h2>
    <span>Everything in one modern place</span>
  </div>

  <div class="grid3">
    <div class="card">
      <h4>Sermon Archive</h4>
      <p>Search sermons by date, speaker, or topic. Keep track of what God is speaking to us.</p>
      <div class="row" style="margin-top:12px"><a class="button" href="/sermons.php">Browse</a></div>
    </div>
    <div class="card">
      <h4>Ministries Directory</h4>
      <p>Kids, Youth, and Adult ministries—find a community that matches your season of life.</p>
      <div class="row" style="margin-top:12px"><a class="button" href="/ministries.php">Explore</a></div>
    </div>
    <div class="card">
      <h4>Location & Times</h4>
      <p>Clear directions and service schedule so you can plan your visit with confidence.</p>
      <div class="row" style="margin-top:12px"><a class="button" href="/location.php">View map</a></div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

