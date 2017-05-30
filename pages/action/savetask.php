<?php
        require_once '/data/website/libble/pages/class/mysql.class.php';
        $db=new Mysql();
        $taskname = $_GET["taskname"];
        $numIters = $_GET["numIters"];
        $data = explode("*",$_GET["data"]);
	$argvals = $data[0];
	for ($i=1; $i<count($data); $i++) { 
		$argvals = $argvals."#".$data[$i];
	}
        $id = $_GET["taskid"];
        $flag=$db->update("Tasks","argvals='".$argvals."',taskname='".$taskname."',numIters=".$numIters,"id=".$id);
	exit;
?>

