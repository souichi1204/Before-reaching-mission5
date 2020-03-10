<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>2-1PHP</title>
</head>
<body>
	<form action=""　 method="POST">
	<p><input type="text" name="com" ><p><!--文字を入力させる-->
	<input type="submit" value="コメント"><!--inputの型指定-->
	
	</form>
<?php
 $filename="mission_2-2.txt";
$fp=fopen($filename,"a");
$fwrite($filename,$_POST["com"],"<br>");
$fclose(resourse $filename);bool
 echo $_POST["com"]."を受け付けました","<br>";//入力フォームから送信されたデータに付与
?>
</form>
</body>
</html>
