<?php
$age=87;
if($age>=18 && $age<85){
	echo "自動車免許が取れます";    //条件が真であれば実行
}elseif($age>=85){
	echo "免許を返納しませんか";  //ifの条件は偽だが、elseifの条件が真の時実行
}else{
 	echo "自動車免許はまだ取得できません";}    //条件が偽で実行
?>