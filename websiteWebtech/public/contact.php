<?php
session_start();

include('../private/shared/header.php');
require_once(__DIR__ . '/../private/utils.php');
?>
    <div class="header contact-header" id="header">
        <?php
        include('../private/shared/navbar.php');
        ?>
        <div class="form-container">
            <h1>Contact</h1>
            <h3>You can also contact us by calling: +12 3 45678901, or by emailing us directly at:
                kimi@restaurant.uva.nl </h3>
            <form action="/api/contact" method="post">
                <label for="firstName">First name:</label>
                <input type="text" placeholder="First name" name="firstName" required>

                <label for="lastName">Last name:</label>
                <input type="text" placeholder="Last name" name="lastName" required>

                <label for="email">Email:</label>
                <input type="text" placeholder="Email" name="email" required>

                <label for="message">Message:</label>
                <textarea placeholder="Message" name="message" required></textarea>

                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

                <input type="submit">
            </form>
        </div>
    </div>
<?php
include('../private/shared/footer.php');
include('../private/shared/cookie_consent.php');
?>