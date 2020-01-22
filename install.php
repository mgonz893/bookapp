if (isset($_POST['submit'])) {
require "config.php";

try {
$connection = new PDO($dsn, $username, $password, $options);

$new_user = array(
"nickname" => $_POST['nickname'];
"password" => $_POST['password'];
"firstname" => $_POST['firstname'],
"lastname" => $_POST['lastname'],
"email" => $_POST['email'],
"address" => $_POST['address'];
"city" => $_POST['city'];
"state" => $_POST['state'];
"zip" => $_POST['zip'];
);

$sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"user",
implode(", ", array_keys($new_user)),
":" . implode(", :", array_keys($new_user))
);

$statement = $connection->prepare($sql);
$statement->execute($new_user);

} catch(PDOException $error) {
echo $sql . "<br>" . $error->getMessage();
}

}