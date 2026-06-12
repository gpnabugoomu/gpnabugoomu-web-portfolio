<?php
$customPageTitle = "Ministries";
include 'header.php';
?>

<main class="container page-content">
    <div class="page-header">
        <h2>Ministries Directory</h2>
        <p>Kids • Youth • Adult</p>
    </div>

    <div class="grid-3">
        <div class="time-card">
            <span class="badge">Ages 0-12</span>
            <h3>Kids Ministry</h3>
            <p>Safe, fun, Bible-centered learning designed for children to grow in faith.</p>
            <div class="actions" style="justify-content: center; margin-top: 20px;">
                <a class="btn-secondary" href="#">Learn More</a>
            </div>
        </div>
        <div class="time-card">
            <span class="badge">Ages 13-18</span>
            <h3>Youth Ministry</h3>
            <p>Mentorship, worship, and discipleship for teenagers—real faith, real life.</p>
            <div class="actions" style="justify-content: center; margin-top: 20px;">
                <a class="btn-secondary" href="#">Learn More</a>
            </div>
        </div>
        <div class="time-card">
            <span class="badge">Adults</span>
            <h3>Adult Ministry</h3>
            <p>Groups, prayer, and community for adults to serve and grow together.</p>
            <div class="actions" style="justify-content: center; margin-top: 20px;">
                <a class="btn-secondary" href="#">Learn More</a>
            </div>
        </div>
    </div>

    <div class="form-container" style="text-align: center; margin-top: 60px;">
        <h2 class="section-title">Looking for a place?</h2>
        <p style="margin:0 0 25px; color:var(--muted)">Tell us your age group and what you’re looking for—we’ll point you to the best ministry.</p>
        <div class="actions" style="justify-content: center;">
            <a class="btn-primary" href="connect.php">Open Connect Card</a>
            <a class="btn-secondary" href="location.php">Plan your visit</a>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
