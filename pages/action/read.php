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
	$count = 0;
	if (($type == 5)||($type == 6)){
		$reg = '/(?<=Test\sAccuracy:\s).+/';
	}else{	
		$reg = '/(?<=\s).+(?=\sat)/';
	}
	$myfile = fopen($filename, "r") or die("Unable to open file!");
	while(!feof($myfile)) {
		$readline = fgets($myfile);
		//echo $readline;
		if (preg_match($reg,$readline,$loss)){
			$count = $count + 1;
			$data = $data.$loss[0].",";
		}
	}
	fclose($myfile);
	if ($count > 0){
		$data = substr($data,0,-1);
	}
	echo $data;
?>
