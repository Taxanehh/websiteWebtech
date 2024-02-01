<?php
session_start();

if (!isset($_SESSION['cookie_consent']) || $_SESSION['cookie_consent'] !== true) {
    echo '<div class="cookie-consent">
              <p>This website uses cookies to enhance your experience. By using our site, you acknowledge that you have read and understand our <a href="#">Cookie Policy</a>.</p>
              <button onclick="acceptCookies()">Accept</button>
          </div>';
}
?>
<script src="/assets/js/cookie.js"></script>
