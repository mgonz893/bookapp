<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['logged'])) {
    echo $_SESSION["username"];
    echo '<a href="logout.php"><span>Logout</span></a></li>';
} else {
    echo '<a href="index.php"><span>Login/Register</span></a></li>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Book Store</title>

    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <p>Book Store</p>
</body>

</html>