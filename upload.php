
<?php

session_start();
require "conn.php";

function random($length){
  $captchaSource = "0123456789abcdefghijklmnopqrstuvwxyz";
  //$captchaResult = "2015"; // 随机数返回值
  //$captchaSentry = ""; // 随机数中间变量
  for($i=0;$i<$length;$i++)
  {
    $n = rand(0, 35); #strlen($captchaSource));
    if($n >= 36)
    {
      $n = 36 + ceil(($n-36)/3) * 3;
      $captchaResult .= substr($captchaSource, $n, 3);
    }
    else
    {
      $captchaResult .= substr($captchaSource, $n, 1);
    }
  }
  return $captchaResult;
}

$allowedExts = array('gif', 'jpg', 'jpeg', 'png');
$temp = explode(".", $_FILES['file']['name']);
$extension = strtolower(end($temp));

$allowedType = array('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/x-png', 'image/png');

if(in_array($extension, $allowedExts) && in_array($_FILES['file']['type'], $allowedType))
{
	if ($_FILES["file"]["error"] > 0)
	{
	    echo "error:" . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
	    echo "filename: " . $_FILES["file"]["name"] . "<br>";
	    echo "file type: " . $_FILES["file"]["type"] . "<br>";
	    echo "file size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
	    echo "file temporary directory: " . $_FILES["file"]["tmp_name"] . "<br/>";

	    $filename = random(10) . "." . $extension;
	    if(move_uploaded_file($_FILES['file']['tmp_name'], "./upload/" . $filename))
	    {
	    	echo "file stored in " . "./upload/" . $filename . "<br />";
	    	$owner = $_SESSION['user'];
	    	$query = "insert into filemsg(fdate, filename, owner) values(now(), '$filename', '$owner')";
	    	$res = mysql_query($query);
	    	if(!$res)
	    	{
	    		echo "insert success!";
	    	}
	    }
	}
}
else
{
	echo "illegal file type!";
}









?>
