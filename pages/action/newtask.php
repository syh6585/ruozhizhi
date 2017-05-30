<?php
	require_once '/data/website/libble/pages/class/mysql.class.php';
	$db=new Mysql();
	$posX = $_GET["posX"];
	$posY = $_GET["posY"];
	$type = $_GET["type"];
	$taskname = "NewTask";
	if ($type == 0){
 		$argnames = "master#driver-memory#executor-memory#driver-cores#total-executor-cores#input path#step size#reg parameter#elastic factor#num of parts#num of classes";
		$argvals = "spark://master:7077#10#20#2#16#/data/epsilon_normalized_converse.txt#0.5#0.0001#0.0001#16#2";
		$argsps = "1#0#0#0#0#0#0#0#0#0#0";
		$argnum = 11;
		$numIters = 10;
	}
	if ($type == 1){
 		$argnames = "master#driver-memory#executor-memory#driver-cores#total-executor-cores#input path#step size#reg parameter#elastic factor#num of parts";
		$argvals = "spark://master:7077#10#20#2#16#/data/epsilon_normalized_converse.txt#0.1#1e-4#1e-6#16";
		$argsps = "1#0#0#0#0#0#0#0#0#0";
		$argnum = 10;
		$numIters = 20;
	}
	if ($type == 2){
 		$argnames = "master#driver-memory#executor-memory#driver-cores#total-executor-cores#input path#step size#reg parameter#elastic factor#num of parts";
		$argvals = "spark://master:7077#10#20#2#16#/data/epsilon_normalized_converse.txt#0.1#1e-4#1e-6#16";
		$argsps = "1#0#0#0#0#0#0#0#0#0";
		$argnum = 10;
		$numIters = 20;
	}
	if ($type == 3){
 		$argnames = "master#driver-memory#executor-memory#driver-cores#total-executor-cores#input path#step size#reg parameter#elastic factor#num of parts";
		$argvals = "spark://master:7077#10#20#2#16#/data/epsilon_normalized_converse.txt#0.1#1e-4#1e-6#16";
		$argsps = "1#0#0#0#0#0#0#0#0#0";
		$argnum = 10;
		$numIters = 20;
	}
	if ($type == 4){
 		$argnames = "master#driver-memory#executor-memory#driver-cores#total-executor-cores#input path#step size#U reg parameter#V reg parameter#rank#num of parts";
		$argvals = "spark://master:7077#40#40#2#32#/data/ALS/netflix_train.txt#0.01#0.05#0.05#40#32";
		$argsps = "1#0#0#0#0#0#0#0#0#0#0";
		$argnum = 11;
		$numIters = 20;
	}
	if ($type == 5){
 		$argnames = "training home#save path#gpu number#learning rate#batch size";
		$argvals = "/home/cheny/cnn_parameter#/home/cheny/cnn_for_remote/test1#8#0.001#256";
		$argsps = "1#0#0#0#0";
		$argnum = 5;
		$numIters = 60;
	}
	if ($type == 6){
		$argnames = "training home#save name#gpu number#learning rate#batch size#dropout rate for hidden states#dropout rate for input";
		$argvals = "/home/xud/Music/rnnForClassification#libbleRNN#2#5e-5#100#0.5#1.0";
		$argsps = "1#0#0#0#0#0#0";
		$argnum = 7;
		$numIters = 50;
	}

	$flag=$db->insert("Tasks","(username,wbid,posX,posY,state,class,numIters,taskname,argnames,argvals,argsps,argnum)","('".$_SESSION["ml_username"]."',".$_SESSION["ml_wbid"].",".$posX.",".$posY.",0,".$type.",".$numIters.",'".$taskname."','".$argnames."','".$argvals."','".$argsps."',".$argnum.")");
        if ($flag) {
		$taskid=$db->lastid();
		echo $taskid;
	}
?>
