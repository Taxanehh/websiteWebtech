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
            <h1>Reservation Dashboard</h1>
                <div style="position:relative">
                    <?php
                    include('../private/classes/admin.php');
                    echo Admin::ReservationsTable();                    
                    ?>
                </div>

                <div style="position:relative">
                <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
                <form action="/api/admin/delete" method="post" target="dummyframe">
                    <label for="id">Delete reservation</label><br>
                    <input type="text" id="id" name="id" placeholder="Reservation ID"><br>
                    <input type="submit" value="Delete">
                </form> 
                <form action="/api/admin/edit" method="post" target="dummyframe">
                    <label for="id">Edit reservation</label><br>
                    <input type="text" id="id" name="id" placeholder="Reservation ID"><br>
                    <input type="text" id="table_id" name="table_id" placeholder="Table ID"><br>
                    <input type="datetime-local" id="start_time" name="start_time" placeholder="Start time"><br>
                    <input type="datetime-local" id="end_time" name="end_time" placeholder="End time"><br>
                    <input type="submit" value="Edit">
                </form> 
                <form action="/api/admin/create" method="post" target="dummyframe">
                    <label for="id">Create reservation</label><br>
                    <input type="text" id="id" name="id" placeholder="Reservation ID"><br>
                    <input type="text" id="user_id" name="user_id" placeholder="User ID"><br>         
                    <input type="text" id="table_id" name="table_id" placeholder="Table ID"><br>
                    <input type="datetime-local" id="start_time" name="start_time" placeholder="Start time"><br>
                    <input type="datetime-local" id="end_time" name="end_time" placeholder="End time"><br>
                    <input type="submit" value="Create reservation">
                </form> 
                </div>
        </div>
    </div>
    <div class="form-container" style="color:white;">
            <h1>Menu Dashboard</h1>
                <div style="position:relative">
                    <?php
                    echo Admin::ItemsTable();                    
                    ?>
                </div>

                <div style="position:relative">
                <form action="/api/admin/item_admin/delete" method="post" target="dummyframe">
                    <label for="id">Delete item</label><br>
                    <input type="text" id="id" name="id" placeholder="Item ID"><br>
                    <input type="submit" value="Delete">
                </form> 
                <form action="/api/admin/item_admin/edit" method="post" target="dummyframe">
                    <label for="id">Edit item</label><br>
                    <input type="text" id="id" name="id" placeholder="Item ID"><br>
                    <input type="text" id="menu_id" name="menu_id" placeholder="Menu ID"><br>
                    <input type="text" id="name" name="name" placeholder="Item name"><br>
                    <input type="number" step="0.01" id="price" name="price" placeholder="Price"><br>
                    <input type="submit" value="Edit">
                </form> 
                <form action="/api/admin/item_admin/create" method="post" target="dummyframe">
                    <label for="id">Create item</label><br>
                    <input type="text" id="menu_id" name="menu_id" placeholder="Menu ID"><br>
                    <input type="text" id="name" name="name" placeholder="Item name"><br>
                    <input type="text" id="description" name="description" placeholder="Item description"><br>
                    <input type="number" step="0.01" id="price" name="price" placeholder="Price"><br>
                    <input type="submit" value="Create item">
                </form> 
                </div>
        </div>
    </div>
</div>
<?php
#include('../private/shared/cookie_consent.php');
?>
