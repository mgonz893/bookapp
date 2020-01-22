<?php
if (isset($_POST['submit'])) {
    try {
        require "config.php";
        require "common.php";

        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT *
  FROM user
  WHERE nickname = :nickname && password = :password";
        $new_user = array(
            $nickname = $_POST['nickname'],
            $password = $_POST['password']
        );
        $statement = $connection->prepare($sql);
        $statement->bindParam(':nickname', $nickname, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php include "header.php"; ?>
<?php
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>

        <body> Login Successful </body>
    <?php } else { ?>
        > Login Unsuccessful for <?php echo escape($_POST['nickname']); ?>.
<?php }
} ?>
<h2>Login</h2>

<form method="post">
    <label for="nickname">Nickname</label>
    <input type="text" id="nickname" name="nickname">
    <label for="password">Password</label>
    <input type="text" id="password" name="password">
    <input type="submit" name="submit" value="Login">
</form>

<a href="index.php">Back to home</a>
<?php include "footer.php"; ?>