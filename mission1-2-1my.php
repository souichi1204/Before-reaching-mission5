<?php
//�����ŏ����Ă݂�
//$hensu�ɕ�������
$hensu="Hello World";

//�e�L�X�g�t�@�C���ǂݍ���
$filename="mission_1-2.txt";
$fp=fopen($filename,"w");

//��������
fwrite( $fp, $hensu);

//����
fclose($fp);

?>