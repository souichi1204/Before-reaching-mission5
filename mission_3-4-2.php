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

	<p><h1>削除番号指定フォーム</h1><p>
	<form action="" method="POST">
	<!--削除番号指定-->
	<p><h3>削除対象番号<h3><p>
	<p><h3>※数字のみを入力して下さい<h3><p>
	<input type="text" name="delete_number">

	<!--削除ボタン送信-->
	<input type="submit" value="削除">
	
	</form>

	<p><h1>編集フォーム</h1><p>
	<!--編集フォーム-->
	<form action"" method="POST">
	
	<!--編集番号指定-->
	<input type="text" name="arrange">

	<!--編集ボタン-->
	<input type="submit" value="編集">
	</form>
<?php
 $filename="mission3.txt";

//もし入力フォームに投稿されたなら
if(!empty($_POST["name"]) && !empty($_POST["com"])){
 $name=$_POST["name"];
 $comment=$_POST["com"];
 date_default_timezone_set("Asia/Tokyo");
  $timestamp=time();
 $jikan=date("Y/m/d/ H:i:s",$timestamp);
 $filename="mission3.txt";
 //ファイルがあるかどうか
 if(file_exists($filename)){
	//ファイルの一行目が削除されている場合
	if(empty($filename)){
			touch("mission3.txt");
			$count=1;
			$lines=file($filename);}

	$lines=file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	//最終行取得
	$k=$lines[count($lines)-1];
	$array_lastline=explode("<>",$k);
	$get_last_count=$array_lastline[0]; 
	$count=$get_last_count+1; }
	
else{
	touch("mission3.txt");
	$count=1;
	$lines=file($filename);

}

$fp=fopen($filename,"a");

fwrite($fp,$count."<>".$name."<>".$comment."<>".$jikan."\r\n");
echo "投稿が完了しました"."<br>";
echo "以前いただいたコメントはこちら"."<br>";

//linesに新しく値が代入されたため、最新のを表示したいなら再代入必要
$lines=file($filename);

foreach($lines as $v){
$num=explode("<>",$v);
echo $num[0],$num[1],$num[2],$num[3],"<p>";
}
fclose($fp);
}

//削除指定番号フォームに投稿されたなら
elseif(!empty($_POST["delete_number"])){
//定義
  $lines=file($filename);


//ファイル内に文字があるかどうか
if(!empty($filename)){
 $dnumber=$_POST["delete_number"];
 unlink("mission3.txt");
 $fp=fopen($filename,"a");
 
//$vは一行を指す
 foreach($lines as $v){
$num=explode("<>",$v);//$num[0]-num[3]まで配列として保存される
if($num[0]!=$dnumber){
fwrite($fp, $v);
//dnumberのファイルがtext内に存在しない場合
}
}
fclose($fp);
echo $dnumber."番目の削除が完了しました"."<br>";
$file_array=file($filename);
foreach($file_array as $v){
echo $v."<br>";}
}
//編集ボタンが押されたら
elseif(!empty($_POST["arrange"])){
}

//何も入力がない場合
}
?>
</form>
</body>
</html>
