<?php
session_start();

include('../private/shared/header.php');
include ('../private/classes/user.php');
?>
<div class="header main-header" id="header">
    <?php
    include('../private/shared/navbar.php');
    ?>
        <div class="form-container" style="color:white;">
                <h1>Menu's</h1>
                <h2><a href="/roeterseiland.php">Roeterseiland</a></h2>
                <h2><a href="/science_park.php">Science Park</a></h2>
        </div>
    </div>
<?php
#include('../private/shared/cookie_consent.php');
?>
