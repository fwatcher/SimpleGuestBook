<?php

require "./static/header.php";
require "./static/nav.php";

?>

<div id="section">
<h2>GuestBook</h2>

<?php
session_start();

if(isset($_SESSION['user']))
{
    echo "hello " . $_SESSION['user'] . ", Please leave your message!" . "<br/>";

?>

<form id="guestbook" name="guestbook" method="POST" action="guestbook.php">
    <textarea name="content" cols="45" rows="5"></textarea>
    <p><input type="hidden" name="issubmit" value = "1" /></p>
    <p><input id = "submit" name = "submit" type="submit" value = "done" /></p>
</form>
</body>

<?php

require "conn.php";



if($_POST['issubmit'] == 1)
{
	$owner = $_SESSION['user'];

	$content = $_POST['content'];

	if(empty($owner) || empty($content))
	{
    	die("empty!");
	}


	$query = "insert into message(mdate, content, owner) values(now(), '$content', '$owner');";

	$res = mysql_query($query);
	if($res)
	{
    	echo "success!";
	}
}
}

?>

</div>

<?php

require "./static/footer.php";

?>
