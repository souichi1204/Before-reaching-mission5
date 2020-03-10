<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>2-1PHP</title>
</head>
<body>
	<h1>2-4終わりました！！<br>何かコメントして頂けたら嬉しいです<br></h1>
	<h3>例:おめでとうございますbyYM</h3>
	<form action=""　 method="POST">
	<p><input type="text" name="com" ><p><!--文字を入力させる-->
	<input type="submit" value="コメント"><!--inputの型指定-->
	
	</form>
<?php
 
 $filename="mission_2-4.txt";//読み込みファイルの指定
 $file_array=file($filename);//$filenameの内容を配列に格納
 if(! empty($post["com"])){
	$comment=$_POST["com"];

 //空でないなら2-2のテキストに入力された値を追加する。
if($comment=="完成！"){
 echo "おめでとう！！"."<br>";
}//中のif終了
 $fp=fopen($filename,"a");
 fwrite($fp,$comment."\r\n");
 //入力フォームから送信されたデータに付与
 echo $comment. "を受け付けました","<br>";//
 echo "<皆様から頂いたコメント>"."<br>";
 foreach($file_array as $value){
 echo $value."<br>";
}//foreach終了

 
 fclose($fp);
}else{
 //フォームが空であるかどうかを確認する
  echo "値を入力してください";
}

?>
</form>
</body>
</html>
