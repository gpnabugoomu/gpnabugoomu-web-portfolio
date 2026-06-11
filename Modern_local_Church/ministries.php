<?php
$pageTitle = "Ministries - Gideon’s Church";
require __DIR__ . '/includes/header.php';
?>

<section>
  <div class="sectionTitle">
    <h2>Ministries Directory</h2>
    <span>Kids • Youth • Adult</span>
  </div>

  <div class="grid3">
    <div class="card">
      <h4>Kids Ministry</h4>
      <p>Safe, fun, Bible-centered learning designed for children to grow in faith.</p>
      <div class="row" style="margin-top:12px">
        <a class="button" href="#">Learn More</a>
      </div>
    </div>
    <div class="card">
      <h4>Youth Ministry</h4>
      <p>Mentorship, worship, and discipleship for teenagers—real faith, real life.</p>
      <div class="row" style="margin-top:12px">
        <a class="button" href="#">Learn More</a>
      </div>
    </div>
    <div class="card">
      <h4>Adult Ministry</h4>
      <p>Groups, prayer, and community for adults to serve and grow together.</p>
      <div class="row" style="margin-top:12px">
        <a class="button" href="#">Learn More</a>
      </div>
    </div>
  </div>

  <div class="sectionTitle" style="margin-top:26px">
    <h2>Looking for a place?</h2>
    <span>Start with a Connect Card</span>
  </div>
  <div class="panel">
    <p style="margin:0 0 12px; color:var(--muted)">Tell us your age group and what you’re looking for—we’ll point you to the best ministry.</p>
    <div class="row">
      <a class="button primary" href="/connect.php">Open Connect Card</a>
      <a class="button" href="/location.php">Plan your visit</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>

