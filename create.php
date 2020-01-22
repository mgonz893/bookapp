<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
if (isset($_POST['submit'])) {
    require "config.php";
    require "common.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "nickname" => $_POST['nickname'],
            "password" => $_POST['password'],
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "address" => $_POST['address'],
            "city" => $_POST['city'],
            "state" => $_POST['state'],
            "zip" => $_POST['zip']
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "user",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include "header.php"; ?><h2>create profile</h2>
<form method="post">
    <label for="nickname">Nickname</label>
    <input type="text" name="nickname" id="nickname">
    <label for="password">Password</label>
    <input type="text" name="password" id="password">
    <label for="firstname">First Name</label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name</label>
    <input type="text" name="lastname" id="lastname">
    <label for="email">Email Address</label>
    <input type="text" name="email" id="email">
    <label for="address">Address</label>
    <input type="text" name="address" id="address">
    <label for="city">City</label>
    <input type="text" name="city" id="city">
    <label for="state">State</label>
    <input type="text" name="state" id="state">
    <label for="zip">Zip Code</label>
    <input type="text" name="zip" id="zip">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "footer.php"; ?>