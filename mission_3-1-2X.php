<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<form action="mission_3-1-2.php" method="post">
名前:<input type="text" name="name" size="30" value="" /><br />
コメント:<input type="text" name="comment" size="30" value="" /><br />
<input type="submit" value="送信" />
</form>

<?php 
$filename="mission_3-1-2.txt";
if(empty($_POST["name"]) and empty($_POST["comment"])){
echo "";}
else{
$name=$_POST["name"];
$comment=$_POST["comment"];
$file=file("mission_3-1-2.txt");
$number=count(($file)+1);
$fp = fopen($filename ,"a");
fwrite( $fp,"(".$number.")"."<>"."(".$name.")"."<>"."(".$comment.")"."<>".date("y/m/d h:i:s")."\n");
fclose( $fp );
}
?>

</body>
</html>