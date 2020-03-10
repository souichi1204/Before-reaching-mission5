<?php

$message = "game";
$filename = "mission_1-2-1.txt";

$fp = fopen($filename ,"w");
fwrite( $fp ,  $message );
fclose( $fp );

?>