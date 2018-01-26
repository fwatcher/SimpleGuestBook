<?php

require "./static/header.php";
require "./static/nav.php";


?>


<div id="section">
<h2>File Manager</h2>

<?php

session_start();

require "conn.php";

if(isset($_SESSION['user']))
{

?>	

<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="file">
    <input type="submit" name="submit" value="upload">
</form>


<?php



if(isset($_GET['delete']))
{
	$tmp = $_GET['delete'];
	$query = "select owner from filemsg where id = " . $tmp;
	$res = mysql_query($query);
	$row = mysql_fetch_array($res);

	if($_SESSION['user'] ==$row['owner'])
	{
		$dquery = "delete from filemsg where id = " . $tmp;
		$dres = mysql_query($dquery);
	}

}


$query = "select * from filemsg where owner = '" . $_SESSION['user'] . "'";
$res = mysql_query($query);

echo "<p><table border = 1>";
echo "<tr><th>id</th><th>date</th><th>filename</th><th>owner</th><th>action</th></tr>";

while($row = mysql_fetch_array($res))
{
    echo "<tr>";
    echo "<th>" . $row['id'] . "</th>";
    echo "<th>" . $row['fdate'] ."</th>";
    echo "<th><a href = ./upload/" . $row['filename'] . ">" . $row['filename'] ."</th>";
    echo "<th>" . $row['owner'] . "</th>";
    echo "<th><a href =file.php?delete=" . $row['id'] . ">delete</a></th>";

    echo "</tr>";	
}

echo "</table></p>";



}

?>


</div>

<?php

require "./static/footer.php";

?>