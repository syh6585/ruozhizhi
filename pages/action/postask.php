<?php
	require_once '/data/website/libble/pages/class/mysql.class.php';
	$db=new Mysql();
	$posX = $_GET["posX"];
	$posY = $_GET["posY"];
	$id = $_GET["taskid"];
	$flag=$db->update("Tasks","posX=".$posX.",posY=".$posY,"id=".$id);
        if ($flag) {
		$taskid=$db->lastid();
		echo $taskid;
	}
?>
