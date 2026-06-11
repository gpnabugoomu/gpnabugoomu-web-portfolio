<?php
$pageTitle = "Location & Times - Gideon’s Church";
require __DIR__ . '/includes/header.php';
?>

<section>
  <div class="sectionTitle">
    <h2>Location & Service Times</h2>
    <span>Plan your visit</span>
  </div>

  <div class="heroGrid" style="align-items:start">
    <div class="panel">
      <h3>Service Schedule</h3>
      <p>
        <b>Sunday</b><br/>
        8:00 AM — Morning Worship<br/>
        10:00 AM — Worship &amp; Word<br/><br/>
        <b>Wednesday</b><br/>
        5:30 PM — Prayer &amp; Bible Study
      </p>

      <div class="sectionTitle" style="margin:18px 0 10px"><h2 style="font-size:15px">What to expect</h2><span></span></div>
      <div class="grid3" style="grid-template-columns:1fr; gap:10px">
        <div class="card" style="padding:14px"><h4 style="margin:0 0 6px">Warm welcome</h4><p style="margin:0">Our team will help you find parking and seating.</p></div>
        <div class="card" style="padding:14px"><h4 style="margin:0 0 6px">Kids Ministry</h4><p style="margin:0">A safe, Bible-based environment for children.</p></div>
        <div class="card" style="padding:14px"><h4 style="margin:0 0 6px">Connect Card</h4><p style="margin:0">Fill it out online and we’ll meet you at the door.</p></div>
      </div>

      <div class="row" style="margin-top:14px">
        <a class="button primary" href="/connect.php">Submit Connect Card</a>
        <a class="button" href="/sermons.php">Read sermons</a>
      </div>
    </div>

    <div class="panel">
      <h3>Map</h3>
      <p class="muted" style="margin-bottom:12px">
        Update the embed link with your church address.
      </p>
      <div style="border-radius:16px; overflow:hidden; border:1px solid rgba(255,255,255,.10)">
        <iframe
          title="Church Location"
          width="100%"
          height="330"
          style="border:0"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          src="https://www.google.com/maps?q=Kampala%20Uganda&output=embed">
        </iframe>
      </div>
      <div style="margin-top:12px" class="muted small">
        Address: Replace with your exact address.
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

