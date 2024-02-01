<?php
session_start();

include('../private/shared/header.php');
require_once(__DIR__ . '/../private/utils.php');
require_once(__DIR__ . '/../private/classes/location.php');

if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}
?>
    <div class="header main-header" id="header">
        <?php
        include('../private/shared/navbar.php');
        ?>
        <div class="form-container">
            <h1>Reserve a table</h1>
            <h3>You can also contact us by calling: +12 3 45678901, or by emailing us directly at:
                kimi@restaurant.uva.nl </h3>
            <form action="/api/reservation" method="post">
                <label for="location">Location:</label>
                <?php
                // Get all locations, and display them in a dropdown.
                $locations = Location::getAll();

                // Get the nearest location based on the user's IP address.
                if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                $nearestLocation = getCoordinates($ip);
                if ($nearestLocation === null) {
                    // Fallback to Roeterseiland
                    $nearestLocation = array('latitude' => 52.364, 'longitude' => 4.911);
                }
                $nearestLocation = Location::getNearest($nearestLocation['latitude'], $nearestLocation['longitude']);

                echo '<select name="location" id="location" required>';
                foreach ($locations as $location) {
                    $selected = '';
                    if ($location->id === $nearestLocation->id) {
                        $selected = 'selected';
                    }
                    echo "<option value='{$location->id}' {$selected}>{$location->name}</option>";
                }
                echo '</select>';

                echo '<label for="table">Table:</label>';
                echo '<select name="table" id="table" required data-location-id="' . $nearestLocation->id . '">';
                echo '</select>';

                echo '<label for="peopleAmount">Amount of People:</label>';
                echo '<select name="peopleAmount" id="peopleAmount" required data-location-id="' . $nearestLocation->id . '">';
                echo '</select>';
                ?>

                <label for="startTime">Start Time:</label>
                <select name="startTime" id="startTime" required>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                </select>

                <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

                <input type="submit">
            </form>
        </div>
    </div>
    <script src="/assets/js/reservations.js"></script>

<?php
include('../private/shared/footer.php');
include('../private/shared/cookie_consent.php');
?>