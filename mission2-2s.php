<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <form action="mission_2-2.php" method="post">
    <div>
        <label for = "message">「完成！」と打つといいことがあるよ</label><br>
        box:<input type = "text" name = "comment"/>
    </div>

    <div class = "button">
        <button type ="submit">送信</button>
    </div>
    </form>
<?php
  if (empty($_POST["comment"])) {
    echo "コメントを入力してください。";
    }else{
    $comment = $_POST["comment"];
    if ($comment == "完成！"){
        echo "おめでとう！";
        $filename = "mission_2-2.txt";
        $str = mb_convert_encoding($comment,"sjis","utf-8");
        $fp = fopen($filename ,"w");
        fwrite( $fp ,  $str );
        fclose( $fp );
    }
    elseif ($comment != ""){
        echo $comment." を受け付けました。";
        $filename = "mission_2-2.txt";
        $str = mb_convert_encoding($comment,"sjis","utf-8");
        $fp = fopen($filename ,"w");
        fwrite( $fp ,  $str );
        fclose( $fp );
    }else{
        echo "入力されていません";
    }}