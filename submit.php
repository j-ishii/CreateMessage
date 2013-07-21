<?php

$ipAddress = $_SERVER["REMOTE_ADDR"];
$dateandtime = date("Y-m-d H:i:s"); 
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$timezone =  date_default_timezone_get();

echo "アップロードファイル名　：　" , $_FILES["video"]["name"] , "<BR>";
echo "MIMEタイプ　：　" , $_FILES["video"]["type"] , "<BR>";
$size = $_FILES["video"]["size"];
echo "ファイルサイズ　：　" , $size , "<BR>";
$tmpfile = $_FILES["video"]["tmp_name"];
echo "テンポラリファイル名　：　" , $tmpfile , "<BR>";
echo "エラーコード　：　" , $_FILES["video"]["error"] , "<BR>";
echo "送信者名　：" , $_POST["fullname"] , "<BR>";
echo "メッセージ内容　： " , $_POST["message"] , "<BR>";

$filename = $_FILES["video"]["name"] .'.webm';
$savefolder = 'movies';

if(isset($size)){
	$result = move_uploaded_file($tmpfile, './' . $savefolder . '/' . $filename);
	if($result == true){
		echo "upload success";
		$sentence = '"' . $_POST["fullname"] . '",';
		$sentence .= '"' . $_POST["message"] . '",';
		$sentence .= '"' . $filename . '",';
		$sentence .= '"' . $savefolder . '",';
		$sentence .= '"' . $ipAddress . '",';
		$sentence .= '"' . $dateandtime . '",';
		$sentence .= '"' . $user_agent . '",';
		$sentence .= '"' . $timezone . '",';
		$sentence .= '"' . '1' . '"' . "\n";
		$fp = fopen("databasefile.csv","a");
		fwrite($fp,$sentence);
		$fclose($fp);
	}else{
		echo "upload failed";
	}
}else{
	echo "no file uploaded error!";
}

//header('Access-Control-Allow-Origin:*');

?>


<!DOCTYPE html>
<html lang="jp">
<head>
	<meta charset="utf-8">
	<title>movie submit page</title>	


</head>  
  
<body>

</body>

</html>