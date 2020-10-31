<?php
error_reporting(0);
header('Access-Control-Allow-Origin:*');
require('./config.php');
$file = $_FILES['file']['tmp_name'];
$news = time().'.jpg';
copy($file,$news);
$ch = curl_init();
curl_setopt($ch,CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,'https://zhiqiu.baidu.com/imcswebchat/api/file/upload');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,['file' => new \CURLFile(realpath($news))]);
if(curl_exec($ch) === false){
    echo 'Curl error: ' . curl_error($ch);
}
$result = curl_exec($ch);
curl_close($ch);
print_r($result);
unlink($news);
$arr = json_decode($result,true);
if($arr['state'] == 'SUCCESS')
$y = $arr['url'];
$sql = "insert into $d_table(urls) values('$y')";
$pdo->query($sql);
$pdo=null;