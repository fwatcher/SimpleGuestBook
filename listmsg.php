<?php

require "./static/header.php";
require "./static/nav.php";

?>

<div id="section">
<h2>GuestBook</h2>

<form name = "page" method="POST" action="listmsg.php">
    <p><input type="hidden" name="issubmit" value="1" /></p>
    <p>page:<input type="text" name="page"><input id = "submit" name = "submit" type="submit" value = "submit" /></p>
</form>

<?php

require "conn.php";

session_start();

function msgprint($page, $total)
{
    $totalpage = $total / 5;
    $last = $total % 5;

    if($totalpage+1 < $page)
    {
        die("we don't have this page!");
    }

    $page = ($page-1) * 5;

    $query = "select * from message limit $page, 5";

    $res = mysql_query($query);

    echo "<table border = 1>";
    echo "<tr><th>ID</th><th>owner</th><th>content</th><th>time</th></tr>";

    while($row = mysql_fetch_array($res))
    {
        echo "<tr>";
        echo "<th>" . $row['id'] . "</th>". "<th>" . $row['owner'] ."</th>". "<th>" . $row['content'] . "</th>" . "<th>" . $row['mdate'] . "</th>";
        echo "</tr>";
    }
    echo "</table>";


}

if($_SESSION['user'] == 'admin')
{
    $count = "select count(*) as total from message";
    $res = mysql_query($count);
    $total = mysql_fetch_array($res);

    $total = $total['total'];

    if(!isset($_POST['page']))
    {
        $page = 1;
    }
    elseif($_POST['issubmit'] == 1)
    {
        $page = $_POST['page'];
    }

    msgprint($page, $total);




}


?>

</div>

<?php

require "./static/footer.php";

?>