<?php
// Log out user and redirect to homepage
session_start();
session_destroy();
header("Location: /");
exit();