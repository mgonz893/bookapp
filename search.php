<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['submit'])) {
    try {
        require "config.php";
        require "common.php";

        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT *
  FROM books
  WHERE genre = :genre";
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
        <?php $_SESSION["username"] = $nickname;
        $_SESSION["logged"] = true;
        ?>
    <?php } else { ?>
        > Login Unsuccessful for <?php echo escape($_POST['nickname']); ?>.

<?php }
} ?>
<h2>Search</h2>

<form method="post">
    <select name="genre">
        <option value="horror">Horror</option>
        <option value="thriller">Thriller</option>
        <option value="fantasy">Fantasy</option>
        <option value="action">Action</option>
    </select>
    <input type="submit" name="genresearch" value="Submit">
</form>

<a href="index.php">Back to home</a>
<?php include "footer.php"; ?>