<?php
$customPageTitle = "Location & Times";
include 'header.php';
?>

<main class="container page-content">
    <div class="page-header">
        <h2>Location & Service Times</h2>
        <p>Plan your visit to Gideon’s Church</p>
    </div>

    <div class="grid-3" style="align-items:start">
        <div class="time-card" style="text-align: left;">
            <h3>Service Schedule</h3>
            <p style="color: var(--text); margin-bottom: 20px;">
                <strong>Sunday</strong><br/>
                8:00 AM — Morning Worship<br/>
                10:00 AM — Worship &amp; Word<br/><br/>
                <strong>Wednesday</strong><br/>
                5:30 PM — Prayer &amp; Bible Study
            </p>

            <h4 style="color: var(--brand); margin-bottom: 15px;">What to expect</h4>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <div class="sermon-card" style="padding: 15px;"><h4 style="margin:0">Warm welcome</h4><p style="margin:0; font-size: 0.85rem;">Our team will help you find parking and seating.</p></div>
                <div class="sermon-card" style="padding: 15px;"><h4 style="margin:0">Kids Ministry</h4><p style="margin:0; font-size: 0.85rem;">A safe, Bible-based environment for children.</p></div>
                <div class="sermon-card" style="padding: 15px;"><h4 style="margin:0">Connect Card</h4><p style="margin:0; font-size: 0.85rem;">Fill it out online and we’ll meet you at the door.</p></div>
            </div>

            <div class="actions" style="margin-top: 25px;">
                <a class="btn-primary" href="connect.php">Connect</a>
                <a class="btn-secondary" href="sermons.php">Sermons</a>
            </div>
        </div>

        <div class="time-card" style="grid-column: span 2; text-align: left;">
            <h3>Map & Address</h3>
            <p class="muted" style="margin-bottom:20px">Address: Kampala, Uganda (Update with your specific location)</p>
            <div style="border-radius:16px; overflow:hidden; border:1px solid var(--panel-border)">
                <iframe
                    title="Church Location"
                    width="100%"
                    height="400"
                    style="border:0"
                    loading="lazy"
                    src="https://www.google.com/maps?q=Kampala%20Uganda&output=embed">
                </iframe>
            </div>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
