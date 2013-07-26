<?php

$ipAddress = $_SERVER["REMOTE_ADDR"];
$dateandtime = date("Y-m-d H:i:s"); 
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$timezone =  date_default_timezone_get();

$flag = $_POST['flag'];
if($flag){
	$size = $_FILES["video"]["size"];
	$tmpfile = $_FILES["video"]["tmp_name"];
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
			fclose($fp);
			echo "upload success!!";
		}else{
			echo "upload failed";
		}
	}else{
		echo "no file uploaded error!";
	}
}else{
	$type = $_FILES["video"]["type"];
	$size = $_FILES["video"]["size"];
	$tmpfile = $_FILES["video"]["tmp_name"];

	$extention = null;

	if($type === "video/webm"){
		$extention = ".webm";
	}else if($type === "video/mepg"){
		$extention = ".mepg";
	}else if($type === "video/mp4"){
		$extention = ".mp4";
	}else if($type === "video/ogg"){
		$extention = ".ogv";
	}else if($type === "video/quicktime"){
		$extention = ".mov";
	}else if($type === "video/x-msvideo"){
		$extention = ".avi";
	}

	if(isset($size)){

		$filename = $_FILES["video"]["name"] .$extention;
		$savefolder = 'notRTCmovies';

		if(!is_null($extention)){
			$result = move_uploaded_file($tmpfile, './' . $savefolder . '/' . $filename);
			if($result == true){
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
				fclose($fp);
				echo "upload success!!";
			}else{
				echo "upload failed";
			}
		}else{
			echo "file type is unsupported error!";
		}
	}else{
		echo "no file uploaded error!";
	}

}

//header('Access-Control-Allow-Origin:*');

?>
