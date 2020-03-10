<html>
<head><title>input.html</title></head>
<body>

掲示板

<form action="mission_3-4-x.php" method="post">

<?php if(!empty($_POST["henshu"])){
				
   	 $filename = "mission_3-4-x.txt";
	
	if(file_exists($filename)){  //ファイルが存在する場合……①
                  $ar_txt = file($filename); 
                  $ar_count = count($ar_txt);
             
                  if($ar_count != 0){ //…「fileが存在して中身がある場合」……② 新しく最終行を取得する必要がないため下削除（吉野)。
                   

			$hen = $_POST["henshu"];  //…編集ポスト送信 
			unlink($filename);//ここでいったんファイルを削除します。しかし、ar_txtの中には配列化した文章が入ったままなので安心してください。            
			$fp = fopen($filename,"a"); //<-wモードだと他全て消えてしまうのでaにしましょう。                                      
			
			
			foreach($ar_txt as $val){ //…⑥ループさせ
			$hen_data = explode("<>",$val);  //…４行目までを<>で分割
			if($hen_data[0] == $hen ){  //…⑦１行目（投稿番号）と編集ポストが合致する場合
			for($i = 0 ; $i <=3 ; $i++){   //…⑧４行目までをループ 
			fwrite($fp,$hen_data[$i]."\r\n"); //ファイルには名前とコメントを書き込み			
			}}} //…⑥⑦⑧閉じ
			fclose($fp);
	
			$line = file($filename); //それぞれの配列を格納し↓の名前、コメント、編集対象番号フォームにそれぞれ表示させるようにする。
		}
	}		
  } else { " "; } ?>
    
   名前:<br />
   <input type   = "text" name = "name" 
   value =  
   "<?php if(!empty($_POST["henshu"])){   	
   echo  $hen_data[1];
	}else { " "; } ?>"
	placeholder = "名前"><br />
   
   コメント:<br />
   <input type="text" name="comment" 
   value =   
   "<?php if(!empty($_POST["henshu"])){    
   echo $hen_data[2];  	 
   	 } else { " "; } ?>" 
   	 placeholder = "コメント"><br />
   	 
   <input type = "text" name = "number" 
   value = 
   "<?php if(!empty($_POST["henshu"])){
   	echo $hen_data[0];
   }else{ " " ;} ?>"
    placeholder = "編集対象番号"><br />
  
   <input type="submit" value="送信"><br />      
   
   <br />
   削除番号：<br />
   <input type = "text" name = "delete" placeholder = "削除対象番号"><br />
   <input type = "submit" name = "deleteNo"  value = "削除"><br /> 
   編集<br />
   <input type = "text" name = "henshu" placeholder = "編集対象番号"><br />
   <input type = "text" name = "hennshu_password" placeholder = "パスワード"><br />
   <input type = "submit" name = "send_henshu" value = "編集">
   
   </form>

<?php
               
   $filename = "mission_3-4-x.txt";
   $timestamp=time();                
   $date=date("Y/m/d/ H:i:s",$timestamp);   
          
if(file_exists($filename)){  //ファイルが存在する場合……①
                  $ar_txt = file($filename); 
                  $ar_count = count($ar_txt);
             
                  if($ar_count != 0){ //…「fileが存在して中身がある場合」……②
                    $ar_last = $ar_count-1; //…「テキストファイル文字列の行数?1を最終行と定義」
                    $last_exp = explode("<>",$ar_txt[$ar_last]); //…「文字列を<>で分割」
                    $count = $last_exp[0] + 1; //…「最終行+１の投稿番号取得」               	
               		}else{     //…②を閉じ「fileが存在するが中身がない時」の条件分岐……③
  	              		$count = 1;  	             		
               		} 	//……③閉じ
	}else{	//①を閉じて、「fileが存在しない時」の条件分岐……④
               		$count = 1;
               		$fp = fopen($filename,"w");
	}
 
 //新規コメントフォーム
 
 if(!empty($_POST["name"]) && !empty($_POST["comment"])){ //…① コメントなしでも送信できてしまうため、&&に変更(吉野）
	if(empty($_POST["delete"]) || empty($_POST["henshu"]) || empty($_POST["number"])){  //...②
		
          $name = $_POST["name"];
          $com = $_POST["comment"];  
          $fp = fopen($filename,"a");                                       
          fwrite($fp, $count."<>".$name."<>".$com."<>".$date."\r\n");
          fclose($fp);
          echo "入力ありがとうございました".'<br />' ;        
           
          $ar_txt = file($filename);   //…「ファイルデータ全体を配列に格納」
          foreach($ar_txt as $value){  //…③
          	$ar_exp = explode("<>",$value ); //…「explodeで（）のように分割すると定義。」
         	for($i = 0 ; $i <= 3 ; $i++){  //…④「explodeで分割した文字列の４行目までをループ。」
          		echo $ar_exp[$i]." ";  //…「インデックスを$iとして表示。」
        	}   //…④閉じ
         echo '<br />';
 
    //編集機能

}}}elseif(!empty($_POST["henshu"])){
	if(empty($_POST["name"]) || empty($_POST["name"]) || empty($_POST["comment"]) ||empty($_POST["number"])){
		 
        	foreach($line as $value){
        		echo $value;
    }
        echo '<br />';         
        
}}elseif(!empty($_POST["number"]) || !empty($_POST["name"]) || !empty($_POST["comment"])){
	if(empty($_POST["delete"]) || empty($_POST["henshu"])){
													
	$num = $_POST["number"];
	$fp = fopen($filename,"w");   
                                    
	foreach($ar_txt as $val){ //…⑥ループさせ
	$hen_data = explode("<>",$val);  //…４行目までを<>で分割
	for($i = 0 ; $i <=3 ; $i++){   //…⑧４行目までをループ 
		if($hen_data[0] == $num ){  //…⑦編集対象番号と一致する時
			$re_line1 = array_replace($ar_exp[1],$hen_data[1]);
			$re_line2 = array_replace($ar_exp[2],$hen_data[2]);
	fwrite($fp,$hen_data[0].$re_line1.$re_line2.$hen_data[3]."\r\n");
	}}} //…⑥⑦⑧閉じ
	fclose($fp);
	
	$hen_line = file($filename);
	foreach($hen_line as $value){
	echo $value;

//削除機能

}}} elseif(!empty($_POST["delete"])){  //…①
   if(empty($_POST["name"]) || empty($_POST["comment"]) || empty($_POST["henshu"])){  //…②
   	     
	$name = $_POST["name"];
	$com = $_POST["comment"]; 
	$hen = $_POST["henshu"];      
	$del = $_POST["delete"];  //…削除のポスト送信             
	$fp = fopen($filename,"w");                                       
	
	foreach($ar_txt as $val){ //…⑥ループさせ
		$del_data = explode("<>",$val);  //…４行目までを<>で分割
			if($del_data[0] !== $del ){  //…⑦１行目（投稿番号）と削除ポストが合致しない場合
			for($i = 0 ; $i <=3 ; $i++){   //…⑧４行目までをループ          
			fwrite($fp,$del_data[$i] ."\r\n");
	}}} //…⑥⑦⑧閉じ
	fclose($fp);  
	$line = file($filename);
	foreach($line as $value){
		echo $value;
	}
	echo '<br />';
           	
}}
else{  // …上の①②閉じ、①②との分岐
echo "入力してください";            
}   //…①分岐閉じる。

       
       
       
?>



</body>   
</html>