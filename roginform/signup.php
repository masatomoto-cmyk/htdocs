<?php
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Here you would typically add code to save the user to a database
    echo "User $username signed up successfully!";
}
