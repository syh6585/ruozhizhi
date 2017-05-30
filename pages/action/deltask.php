<?php
	require_once '/data/website/libble/pages/class/mysql.class.php';
      	$db=new Mysql();
	$flag=$db->delete("Tasks","id=".$_SESSION['ml_taskid']);
	if ($flag){
		unlink("/data/website/libble/task/".$_SESSION['ml_taskid'].".txt");
	}
	//header("Location:../index.php");
?>
