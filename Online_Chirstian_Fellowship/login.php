<?php include 'includes/header.php'; ?>

<main class="section-padded">
  <div class="container text-center">
    <h2 class="section-title">Login to Your Account</h2>
    <p class="section-subtitle">Access your personalized fellowship experience.</p>
    <!-- Login Form Placeholder -->
    <div style="max-width: 400px; margin: 30px auto; padding: 20px; background: var(--panel); border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.1);">
      <form action="#" method="POST">
        <div style="margin-bottom: 15px;">
          <input type="email" placeholder="Email" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.15); background: rgba(0,0,0,0.2); color: var(--text);">
        </div>
        <div style="margin-bottom: 20px;">
          <input type="password" placeholder="Password" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid rgba(255,255,255,0.15); background: rgba(0,0,0,0.2); color: var(--text);">
        </div>
        <button type="submit" class="btn btn-primary btn-large" style="width: 100%;">Login</button>
      </form>
      <p style="margin-top: 20px; font-size: 14px;">Don't have an account? <a href="register.php" style="color: var(--brand);">Register here</a></p>
    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>