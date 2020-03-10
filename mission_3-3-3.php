<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>2-1PHP</title>
</head>
<body>
	<p><h1>入力フォーム</h1></p>
	<form action=""　 method="POST">
	
	<!--名前入力フォーム-->
	<p><h3>名前</h3></p>
	<p><input type="text" name="name"><p>
	
	<!--コメント入力フォーム-->
	<p><h3>コメント<h3><p>
	<p><input type="text" name="com" ><p>
	
	<!--送信ボタン-->
	<input type="submit" value="送信">

	<p><h1>削除番号指定フォーム</h1><p>
	
	<!--削除番号指定-->
	<p><h3>削除対象番号<h3><p>
	<input type="text" name="delete_number">

	<!--削除ボタン送信-->
	<input type="submit" value="削除">
	
	</form>
<?php
 $filename="mission3.txt;

//もし入力フォームに投稿されたなら
if(!empty($_POST["name"]) && !empty($_POST["com"])){
 if(empty($_POST["deleate_number"])){
 $name=$_POST["name"];
 $comment=$_POST["com"];
 date_default_timezone_set("Asia/Tokyo");
  $timestamp=time();
 $jikan=date("Y/m/d/ H:i:s",$timestamp);

 //ファイルがあるかどうか
 if(file_exists($filename)){
	$lines=file($filename);
	$file_array=file($filename);
	$count=count(file($filename))+1;}
else{
	$count=1;


}

$fp=fopen($filename,"a");
fwrite($fp,$count."<>".$name."<>".$comment."<>".$jikan."\r\n");
echo "投稿が完了しました"."<br>";
echo "以前いただいたコメントはこちら"."<br>";
fclose($fp);

foreach(file(filename)as $v){
$num=explode("<>","$v");
echo $num[0],$num[1],$num[2],$num[3],"<p>";
}
}
}
//削除指定番号フォームに投稿されたなら
elseif(!empty($_POST["delete_number"])){
 if(empty($_POST["name"] && $_POST["com"])){
 $dnumber=$_POST["delete_number"];
 $fp=fopen($filename,"a");
 $fwrite($fp,$count."<>".$name."<>".$comment."<>".$jikan."\r\n");
 foreach(file(filename)as $v){
$num=explode("<>","$v");
echo $num[0],$num[1],$num[2],$num[3],"<p>";
}
}
//両方に入力されたまたは何も入力がない場合
else{
	echo "値を入力して下さい";
}
?>
</form>
</body>
</html>
