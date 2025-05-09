<?php if (!empty($message)): ?>
  <div class="notification" id="notification-message">
    <p><?php echo htmlspecialchars($message); ?></p>
  </div>
  <script>
    setTimeout(function () {
      const el = document.getElementById('notification-message');
      if (el) el.style.display = 'none';
    }, 5000); // 5000 milliseconds = 5 seconds
  </script>
<?php endif; ?>