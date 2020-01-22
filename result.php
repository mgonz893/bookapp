//database connection

global $conn;

   $servername = "localhost";  //host name

   $username = "username"; //username

   $password = "password"; //password

   $mysql_database = "dbname"; //database name

   //mysqli prepared statement 

   $conn = mysqli_connect($servername, $username, $password) or die("Connection failed: " . mysqli_connect_error());

  mysqli_select_db($conn,$mysql_database) or die("Opps some thing went wrong");



if(isset($_GET['form_submit']))
{

 $IDNUMBER =$_GET['idnumber'];



$stmt = $conn->prepare("select * from your_table_name_here where identification_number=? ");

               $stmt->bind_param('s',$IDNUMBER);

               $stmt->execute();
           $val =  $stmt->get_result();
           $row_count= $val->num_rows;

           if($row_count>0)
           {
               $result =$val->fetch_assoc();

               print_r($result);
           }
           else
           {

             echo "identification_number not Match";
           }

               $stmt->close();
               $conn->close();

}