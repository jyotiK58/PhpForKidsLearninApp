<?php 
require "connection.php";
$username = "jyoti";
$password = "jyoti";
$mysql_query = "select * from users where username like '$username' and password like '$password';";
$result = mysqli_query($conn ,$mysql_query );
if(mysqli_num_rows($result) > 0) {
echo "login success !!!!! Welcome user";
}
else {
echo "login not success";
}
$conn->close();
?>