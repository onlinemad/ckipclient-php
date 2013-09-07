<?php
require("class.CKIP.php");

$ckip = new CKIP();

$ckip->serverIP= "127.0.0.1";
$ckip->serverPort= 9999;
$ckip->username= "username";
$ckip->password= "password";
$ckip->rawText = "首先語料蒐集介面將使用者所指定的網址抓回原始文本 (text)，並針對特定網址自動分析其文體作者等格式，經過使用者檢驗無誤後，將原始文本存入資料庫，準備後續斷詞及詞類標記工作，由於文本中包含各式各樣的未知詞，造成斷詞及詞類標記的困擾，因此後續處理的第一步是先經過未知詞擷取模組擷取未知詞，再將原始文本及抽取出的未知詞送交斷詞標記模";

$ckip->send();
echo $ckip->returnText;

$ckip->getSentence();

foreach ( $ckip->sentence as $s){
	echo $s;
}

?>
