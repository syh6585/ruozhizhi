<?php
	$filename="../../task/".$_GET["fname"];
	//$filename = "default.txt";
	$label = "labels:[";
	$data = "";
	$count = 0;
	$reg = '/(?<=\s).+(?=\sat)/';
	//if (!file_exists("/data/website/ml/111.txt")) echo "not exist!";
	//$myfile = fopen("/data/website/ml/default.txt", "r") or die("Unable to open file!");
	$myfile = fopen($filename, "r") or die("Unable to open file!");
	while(!feof($myfile)) {
		$readline = fgets($myfile);
		//echo $readline;
		if (preg_match($reg,$readline,$loss)){
			$count = $count + 1;
			$label = $label.'"'.$count.'",';
			$data = $data.$loss[0].",";
		}
	}
	fclose($myfile);
	if ($count > 0){
		$label = substr($label,0,-1);
		$data = substr($data,0,-1);
	}
	$label = $label."],";
	//$data = $data."]";
	//$bar = $count*100/$_POST["arg7"];
	//echo $label;
	echo $data;
	//echo $count;
?>
