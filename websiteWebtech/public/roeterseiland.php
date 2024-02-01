<?php
session_start();

include('../private/shared/header.php');
include ('../private/classes/user.php');

$userData = $_SESSION['user'];

$userObject = unserialize($userData);

if (!isset($_SESSION['user']) or $userObject->admin != 1) {
    header("Location: /login");
    exit();
}
?>
<div class="header main-header" id="header">
    <?php
    include('../private/shared/navbar.php');
    ?>
    <div class="form-container" style="color:white;">
            <h1>Menu Roeterseiland</h1>
                <div style="position:relative">
                    <?php
                    include('../private/classes/admin.php');
                    echo Admin::Menu1table();                    
                    ?>
                </div>
        </div>
    </div>
</div>