
<?php

require "./static/header.php";
require "./static/nav.php";

?>


<div id="section">
<h2>Register</h2>

<?php
session_start();

if($_SESSION['user'] == 'admin')
{
    echo "hello, " . $_SESSION['user'] . "<br/>";
    die("<a href = 'login.php?action=logout'>logout</a>");

}
else
{
?>

<form id="login" name="login" method="POST" action="register.php">
    <p>username:<input type = "text"  name = "username" id = "username" /></p>
    <p>password:<input type = "password" name = "password" id = "password" /></p>
    <p>confirm password:<input type = "password" name = "vpassword" id = "password" /></p>
    <p><input id = "submit" name = "submit" type="submit" value = "submit" /></p>
</form>
</body>

<?php

}
?>

<?php

require "conn.php";

$username = $_POST['username'];
$password = $_POST['password'];
$vpassword = $_POST['vpassword'];


if(!empty($username) && !empty($password) && !empty($vpassword))
{
    if($password != $vpassword)
    {
        die("Two input password must be consistent");
    }
}
else
{
    die("username and password can't be empty!");
}

$check = "select * from users where username = $username";

$checkr = mysql_query($check);

if(!($checkr))
{
    die("The username has already existed!");
}

$query = "insert into users(username, password) values('$username', '$password')";

$res = mysql_query($query);

if(!empty($res))
{
    echo "register successful!";

}

?>


</div>

<?php

require "./static/footer.php";

?>
