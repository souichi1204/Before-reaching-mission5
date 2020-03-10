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
	
	</form>
<?php
//定義
date_default_timezone_set("Asia/Tokyo");
 $filename="mission3.txt";
 $file_array=file($filename);
 $name=$_POST["name"];
 $comment=$_POST["com"];
 $timestamp=time();
 $jikan=date("Y/m/d/ H:i:s",$timestamp);
 $file_array=file($filename);
 //ファイルがあるかどうか確認
 if(file_exists($filename)){
	$count=count(file($filename))+1;}
else{
	$count=1;
}
 $num=$count."<>".$name."<>".$comment."<>".$jikan;
 

//名前やコメントが書き込まれなかったときの処理
if($name==null || $comment==null){
echo "値を入力してください"."<br>";}

//書き込まれた後の処理
else{
$fp=fopen($filename,"a");
fwrite($fp,$num."\r\n");
echo "投稿が完了しました"."<br>";
fclose($fp);

foreach($file_array as $v){
echo $v."<br/>";}
}
?>
</form>
</body>
</html>
