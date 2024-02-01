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
            <h1>Menu Science Park</h1>
                <div style="position:relative">
                    <?php
                    include('../private/classes/admin.php');
                    echo Admin::Menu2table();                    
                    ?>
                </div>
        </div>
    </div>
</div>