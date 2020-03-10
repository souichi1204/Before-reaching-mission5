<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>2-1PHP</title>
</head>
<body>
	<form action="mission2-2.php"　 method="POST">
	<p><input type="text" name="com" ><p><!--文字を入力させる-->
	<input type="submit" value="コメント"><!--inputの型指定-->
	
	</form>
<?php
 if(!empty($_POST["com"])){
 $filename="mission_2-2.txt";
 $comment=$_POST["com"];

 //空でないなら2-2のテキストに入力された値を追加する。
 if($comment=="完成!"){
 echo "おめでとう！！"."<br>";
 }
 file_put_contents($filename,$comment,FILE_APPEND);
 echo $comment. "を受け付けました","<br>";//入力フォームから送信されたデータに付与

//値がない時の処理
}else{
  echo "値を入力してください";
}

?>
</form>
</body>
</html>
