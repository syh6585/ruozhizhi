<?php
	require_once '/data/website/libble/pages/class/mysql.class.php';
	$db=new Mysql();
	$posX = $_GET["posX"];
	$posY = $_GET["posY"];
	$taskname = "NewTask";
 	$argnames = "master#driver-memory#executor-memory#driver-cores#total-executor-cores#input path#step size#reg parameter#elastic factor#num of parts#num of classes";
	$argvals = "spark://master:7077#10#20#2#16#/data/epsilon_normalized_converse.txt#0.5#0.0001#0.0001#16#2";
	$argsps = "1#0#0#0#0#0#0#0#0#0#0";
	$flag=$db->insert("Tasks","(username,wbid,posX,posY,state,class,numIters,taskname,argnames,argvals,argsps)","('".$_SESSION["ml_username"]."',".$_SESSION["ml_wbid"].",".$posX.",".$posY.",0,0,10,'".$taskname."','".$argnames."','".$argvals."','".$argsps."')");
        if ($flag) {
		$taskid=$db->lastid();
		echo $taskid;
	}
?>
