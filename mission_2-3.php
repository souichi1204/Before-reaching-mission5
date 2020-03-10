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
 $filename="mission_2-3.txt";
 $comment=$_POST["com"];
 //フォームが空であるかどうかを確認する
 if($comment==null){
  echo "値を入力してください";
}
 //空でないなら2-2のテキストに入力された値を追加する。
 else{
if($comment=="完成！"){
 echo "おめでとう！！"."<br>";
}
 $fp=fopen($filename,"a");
 fwrite($fp,$comment."\r\n");
 
 echo $comment. "を受け付けました","<br>";//入力フォームから送信されたデータに付与
 fclose($fp);
}
?>
</form>
</body>
</html>
