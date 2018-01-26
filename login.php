
<?php

require "./static/header.php";
require "./static/nav.php";

?>

<div id="section">
<h2>Login</h2>

<?php
session_start();

if(isset($_SESSION['user']))
{
    echo "<p>hello " . $_SESSION['user'] . ", You've been logged in.</p>";
    echo "<p>click to <a href = 'login.php?action=logout'>logout</a></p>";
}
else
{
?>

<form id="login" name="login" method="GET" action="login.php">
    <p><input type="hidden" name="action" value = "login"></p>
    <p>username:<input type = "text"  name = "username" id = "username" /></p>
    <p>password:<input type = "password" name = "password" id = "password" /></p>
    <p><input id = "submit" name = "submit" type="submit" value = "submit" /></p>
</form>
</body>
<p>click to <a href = "register.php">register</a></p>

<?php
}

require_once('conn.php');

$action = $_GET['action'];

if($action == 'login')
{
    $username = $_GET['username'];
    $password = $_GET['password'];

    if(empty($username) || empty($password))
    {
        echo "username or password empty!\n";
        exit;
    }

    $query = "select * from users where username = '$username' ";

    $res = mysql_query($query);

    $row = mysql_fetch_array($res);

    $key = is_array($row)?$password == $row['password']:FLASE;
    
    if($key)
    {
        $arr['success'] = 1;
        $arr['msg'] = 'login successfully!';
        $arr['user'] = $row['username'];
    }
    else
    {
        $arr['success'] = 0;
        $arr['msg'] = 'login failed!';
    }
    $_SESSION = $arr;
    echo $arr['msg'];
    header("Location:login.php");



}
else if($action == 'logout')
{
    unset($_SESSION);
    session_destroy();
    header("Location:login.php");    
}




?>



</div>

<?php

require "./static/footer.php";

?>