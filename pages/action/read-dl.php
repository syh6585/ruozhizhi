<?php
	require_once '/data/website/libble/pages/class/mysql.class.php';
        $db=new Mysql();
	$taskid = $_GET["taskid"];
	$result=$db->select("Tasks","id=".$taskid);
        $task = $result->fetch_assoc();
	$type = $task["class"];
	$filename="../../task/".$taskid.".txt";
	//$filename = "default.txt";
	$data = "";
	$data2 = "";
	$count = 0;
	$reg_loss = '/(?<=Train\sLoss:\s).+?(?=\s)/';
	$reg_ac = '/(?<=Test\sAccuracy:\s).+/';
	$myfile = fopen($filename, "r") or die("Unable to open file!");
	while(!feof($myfile)) {
		$readline = fgets($myfile);
		//echo $readline;
		if (preg_match($reg_loss,$readline,$loss)){
			$count = $count + 1;
			$data = $data.$loss[0].",";
		}
		if (preg_match($reg_ac,$readline,$ac)){
			$data2 = $data2.$ac[0].",";
		}
	}
	fclose($myfile);
	if ($count > 0){
		$data = substr($data,0,-1);
		$data2 = substr($data2,0,-1);
	}
	echo $data."#".$data2;
?>
