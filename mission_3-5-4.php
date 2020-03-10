<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>mission3-5PHP</title>
</head>
<body>
<body bgcolor="#10100E" text="#FF0000">
<?php
 
$filename="mission3-5.txt";

//ボタンが押された時
//①HTMLの提出ボタンや削除ボタンに名前を付ける
//②isset(名前)

//もし入力フォームに投稿されたなら
if(!empty($_POST["name"]) && !empty($_POST["com"]) && !empty($_POST["pas"])){

 //mission3-4-8:編集番号の入力があったかどうか
	if(!empty($_POST["count"])){
		$lines=file($filename);
		unlink($filename);
		$fp=fopen($filename,"a");
		foreach($lines as $v){
			$num=explode("<>",$v);
			if($num[0]!=$_POST["count"]){
				fwrite($fp,$num[0]."<>".$num[1]."<>".$num[2]."<>".$num[3]."<>".$num[4]."<>"."\r\n");
				echo $num[0].$num[1].$num[2].$num[3]."<br>";}
			else{
				$num[1]=$_POST["name"];
				$num[2]=$_POST["com"];
				$num[4]=$_POST["pas"];
				fwrite($fp,$num[0]."<>".$num[1]."<>".$num[2]."<>".$num[3]."<>".$num[4]."<>");
				echo  $num[0].$num[1].$num[2].$num[3]."<br>";}
		}fclose($fp);
	}else{
 //定義
		 $name=$_POST["name"];
 		$comment=$_POST["com"];
 		date_default_timezone_set("Asia/Tokyo");
  		$timestamp=time();
		 $jikan=date("Y/m/d/ H:i:s",$timestamp);
 		$filename="mission3-5.txt";
 		//mission5-2パスワード入力追加
 		$pas=$_POST["pas"];
 		//ファイルがあるかどうか
 		if(file_exists($filename)){
			$lines=file($filename);
			//ファイルの一行目が削除されている場合
			if(count($lines)==0){
				touch("mission3-5.txt");
				$count=1;
				$lines=file($filename);}
			else{

			$lines=file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			//最終行取得
			$k=$lines[count($lines)-1];
			$array_lastline=explode("<>",$k);
			$get_last_count=$array_lastline[0]; 
			$count=$get_last_count+1; }
			}
		else{
			touch("mission3-5.txt");
			$count=1;
			$lines=file($filename);

		}

		$fp=fopen($filename,"a");

		fwrite($fp,$count."<>".$name."<>".$comment."<>".$jikan."<>".$pas."<>"."\r\n");
		echo "投稿が完了しました"."<br>";
		echo "皆様のコメントはこちら"."<br>";

		//linesに新しく値が代入されたため、最新のを表示したいなら再代入必要
		$lines=file($filename);

		foreach($lines as $v){
			$num=explode("<>",$v);
			echo $num[0],$num[1],$num[2],$num[3],"<p>";
		}
		fclose($fp);
	}
}

//削除指定番号フォームに投稿されたなら
elseif(!empty($_POST["delete_number"]) && !empty($_POST["pas"])){
	if(ctype_digit($_POST["delete_number"])){
		//定義
  		

		//ファイル内に文字があるかどうか
		if(!empty($filename)){
 				$lines=file($filename);
 				$dnumber=$_POST["delete_number"];
 
 				//mission3-5-4;①delete_numberと一致している行取得②パスワード一致しているか判定
				 foreach($lines as $a){
 					$b=explode("<>",$a);
 					if($b[0]==$dnumber && $b[4]==$_POST["pas"]){
 						unlink("mission3-5.txt");
 						$fp=fopen($filename,"a");
 
						//$vは一行を指す
 						foreach($lines as $value){
							$num=explode("<>",$value);//$num[0]-num[3]まで配列として保存される
							if($num[0]!=$dnumber){
								fwrite($fp, $value);
								//dnumberのファイルがtext内に存在しない場合
							}
						}
						fclose($fp);
						echo $dnumber."番目の削除が完了しました"."<br>";
						$file_array=file($filename);
						foreach($file_array as $values){
							$f=explode("<>",$values);
							echo $f[0].$f[1].$f[2].$f[3]."<br>";}
					}
					
				}
			
		}
	}else{
		echo "削除番号は半角数字での入力をお願いします";
	}
}


//編集ボタンが押されたら
elseif(!empty($_POST["arn"]) && !empty($_POST["pas"])){
		//ファイルがあるかどうか
 		if(file_exists($filename)){
			$lines=file($filename);
			//ファイルの一行目が削除されている場合
			if(count($lines)==0){
				touch("mission3-5.txt");
				$count=1;
				$lines=file($filename);}
			else{

			$lines=file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			//最終行取得
			$k=$lines[count($lines)-1];
			$array_lastline=explode("<>",$k);
			$get_last_count=$array_lastline[0]; 
			$count=$get_last_count+1; }
			}
		else{
			touch("mission3-5.txt");
			$count=1;
			$lines=file($filename);

		}
		//中身が数字かどうか
		if(ctype_digit($_POST["arn"])){ 
			$arrange=$_POST["arn"];
			//テキストを配列にして、改めてファイルを開きループさせる3-4-3
			$lines=file($filename);
			//①編集ナンバーの行特定、②パスワードがあっているか確認
			foreach($lines as $r){
				$exploder=explode("<>",$r);
				//①編集ナンバーと一致している行
				if($exploder[0]==$arrange && $exploder[4]==$_POST["pas"]){
					$fp=fopen($filename,"r");
					foreach($lines as $v){
						$num=explode("<>",$v);
						if($num[0]==$arrange){
							$get_count=$num[0];
							$get_name=$num[1];
							$get_com=$num[2];
							global $get_count,$get_name,$get_com;}
					}
					fclose($fp);
				}
			}
		}else{
			echo "半角数字で番号を指定してください";
		}
	}

//何も入力がない場合
else{
	echo "値が正しくない又は入力されていません。お手数をおかけしますがもう一度入力をお願いします。";}
?>
	<p><strong><h1>夏なので、おすすめのホラー映画やホラーゲームを教えてください</h1></strong><p>
	<p><h1>入力フォーム</h1></p>
	<form action=""　 method="POST">
	
	<!--名前入力フォーム-->
	<p><h3>名前</h3></p>
	<p><input type="text"name="name" value ="<?php if(!empty($get_name)){ echo $get_name;} ?>"></p>
	<p><input type="hidden" name="count" value="<?php if(!empty($get_count)){ echo $get_count;}?>"></p>
	<!--コメント入力フォーム-->
	<p><h3>コメント<h3><p>
	<input type="text" name="com" value="<?php if(!empty($get_com)){echo $get_com;};?>"><BR>
	
	<!--パスワード指定-->
	<p><h3>パスワードを入力して下さい</h3><p>
	<p><input type="text" name="pas"><p>
	
	<!--送信ボタン-->
	<input type="submit" value="送信">
	</form>

	<p><h1>削除番号指定フォーム</h1><p>
	<form action="" method="POST">
	
	<!--削除番号指定-->
	<p><h3>削除対象番号<h3><p>
	<p><h3>※半角数字のみを入力して下さい<h3><p>
	<input type="text" name="delete_number">

	<!--パスワード指定-->
	<p><h3>パスワードを入力して下さい</h3><p>
	<p><input type="text" name="pas"><p>

	<!--削除ボタン-->
	<input type="submit" value="削除">
	
	</form>

	<p><h1>編集フォーム</h1><p>
	<!--編集フォーム-->
	<form action="" method="POST">
	
	<!--編集番号指定-->
	<p><h3>編集する項目の番号を半角数字で入力して下さい</h3><p>
	<input type="text" name="arn">

	<!--パスワード指定-->
	<p><h3>パスワードを入力して下さい</h3><p>
	<p><input type="text" name="pas"><p>

	<!--編集ボタン-->
	<input type="submit" value="編集">
	</form>






</form>
</body>
</html>

