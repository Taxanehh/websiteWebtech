<?php
session_start();

include('../private/shared/header.php');
require_once(__DIR__ . '/../private/utils.php');

if (isset($_SESSION['user'])) {
    header("Location: /dashboard");
    exit();
}
?>
<div class="header main-header" id="header">
    <?php
    include('../private/shared/navbar.php');
    ?>

    <div class="form-container">
        <h1>Register</h1>

        <form action="/api/auth/register" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="kimi@kimi.com"/>

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" placeholder="John"/>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" placeholder="Doe"/>

            <label for="password">Password</label>
            <input type="password" id="password" name="password"/>

            <input type="checkbox" onclick="ShowPass()"/>Show password

            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

            <input type="submit" value="Sign Up"/>

            <a href="/login">Sign In</a>
        </form>
    </div>
</div>

<script src="/assets/js/auth.js"></script>
<?php
include('../private/shared/footer.php');
include('../private/shared/cookie_consent.php');
?>
