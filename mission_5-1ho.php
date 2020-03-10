<html>
<head>
<meta charset="utf-8">
</head>
<body>
<title>好きなお菓子を教えて下さい</title>
<h4>好きなお菓子を教えてください</h4><br>
<br>
<?php
//4-1
$time=date("Y/m/d H:i:s");
$dsn='mysql:dbname=tb-210141db;host=localhost';
	$user='tb-210141';
	$password='vXucVmSwCY';
	$pdo=new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

//4-2	
$sql="CREATE TABLE IF NOT EXISTS holy"　　//データベース内に日付とパスワード欄追加（一度内容を決定してしまってあると反映されないのでcreateの後のテーブル名変える必要あり）
	."("
	."id INT AUTO_INCREMENT PRIMARY KEY,"
	."name char(32),"
	."comment TEXT"
	."registry_datetime DATETIME"
	."password TEXT"
	.");";
	$stmt=$pdo->query($sql);


//_________________送信ボタンが押された時__________________//
if(!empty($_POST["name"])&&!empty($_POST["comment"])&&!empty($_POST["pass"])){
   if($_POST["name"]){
   	
   	   $name=$_POST["name"];
       $com=$_POST["comment"];
       $pass=$_POST["pass"];     
     //________編集番号と投稿番号が同じ時
       if(!empty($_POST["count"])){//空じゃない

//＿＿＿＿変更            	       
	$id =$_POST["count"]; //変更する投稿番号
	$name =$_POST["name"];
	$comment = $_POST["comment"]; //変更したい名前、変更したいコメントは自分で決めること
	$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':')
	$stmt->execute();
	
//＿＿＿＿表示
	$sql = 'SELECT * FROM holy';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
	}
	else{
//__________________空、つまり普通に投稿__________________//        	  
//____________________書き込みと表示_____________________//
          //4-5
           $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment,registry_datetime,password) VALUES (:name, :comment,:registry_datetime,:password)");//時間とパスワードの欄をテーブルに追加したので書き込み時にも追加
	       $sql -> bindParam(':name', $name, PDO::PARAM_STR);
		   $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
		   //データベースに渡す情報が１password２rejistry_datetimeが増えたので、ここにbindparam追加（吉野）
	       $name =$_POST["name"];
	       $comment = $_POST["comment"]; //好きな名前、好きな言葉は自分で決めること
	       $sql -> execute();
    
           $sql = 'SELECT * FROM holy';
	          $stmt = $pdo->query($sql);
	          $results = $stmt->fetchAll();
	           foreach ($results as $row){
		          //$rowの中にはテーブルのカラム名が入る
		             echo $row['id'].',';
		             echo $row['name'].',';
					 echo $row['comment'].'<br>';
					 //上に同じく時間表示させるなら追加
	                 echo "<hr>";
	             }

}
}
}
   //______________削除ボタンが押された時_____________//
elseif(!empty($_POST["delete_number"])&&!empty($_POST["pass"])){
   if($_POST["delete_number"]){
        $delete_number=$_POST["delete_number"];
        $pass=$_POST["pass"];
        $id = $_POST["delete_number"];
	    $sql = 'delete from holy where id=:id';//おそらくこのままだとpasswordが異なっていても削除されてしまうはず。andを用いてpassword=:passwordも追加したほうがいいです。
	    $stmt = $pdo->prepare($sql);
	    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	    $stmt->execute();
	    
	    $sql = 'SELECT * FROM holy';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
		//時間表示
	echo "<hr>";
	}


               echo $delete_number."の投稿が削除されました"."<br>";
       }
             }
//________________編集ボタンが押された時_____________//
    elseif(!empty($_POST["edit"])&&!empty($_POST["pass"])){
    if($_POST["edit"]){
        
        
    $id = $_POST["count"]; //変更する投稿番号
	$name = $_POST["name"];
	$comment = $_POST["comment"]; //変更したい名前、変更したいコメントは自分で決めること
	$sql = 'update holy set name=:name,comment=:comment where id=:id';//96行目参照
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
        
  			}
  			   }


?>
<br>
<form action="mission_5-1.php" method="POST">
・送信フォーム<br>
お名前：<input type="text" name ="name" value="<?php if(!empty($date_name)){ echo $date_name;}?>"><br>
コメント：<input type="text" name="comment" value="<?php if(!empty($date_com)){ echo $date_com;}?>"><br>
<input type="hidden" name="count" value="<?php if(!empty($date_count)){ echo $date_count;}?>">
パスワード：<input type="password" name="pass"><br>
<input type="submit" value="投稿"><br>
</form>
<br>

<form action="mission_5-1.php" method="POST">
・削除フォーム<br>
削除番号：<input type="text" name="delete_number"><br>
パスワード：<input type="password" name="pass"><br>
<input type="submit" value="削除"><br>
</form>
<br>

<form action="mission_5-1.php" method="POST">
・編集フォーム<br>
編集番号：<input type="text" name="edit"><br>
パスワード：<input type="password" name="pass"><br>
<input type="submit" value="編集"><br>
</form>
</body>
</html>
