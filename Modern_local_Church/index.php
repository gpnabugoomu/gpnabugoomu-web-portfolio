<?php 
$customPageTitle = "Home";
include 'header.php'; 
?>

<section class="hero">
    <div class="container hero-inner">
        <div class="hero-content">
            <span class="badge">Welcome to Our Community</span>
            <h1>Discover Hope. Find <span class="highlight">Purpose</span>.</h1>
            <p>Join us this Sunday as we explore faith and community together in a modern, welcoming environment.</p>
            <div class="actions">
                <a href="location.php" class="btn-primary">Plan Your Visit</a>
                <a href="sermons.php" class="btn-secondary">Watch Online</a>
            </div>
        </div>
    </div>
</section>

<section class="service-times">
    <div class="container grid-3">
        <div class="time-card">
            <h3>Sunday Mornings</h3>
            <p>9:00 AM & 11:00 AM</p>
        </div>
        <div class="time-card">
            <h3>Youth Nights</h3>
            <p>Wednesdays at 6:30 PM</p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>