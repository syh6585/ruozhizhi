<?php
	require_once '/data/website/libble/pages/class/mysql.class.php';
	$db=new Mysql();
	$result=$db->select("Tasks","wbid=".$_SESSION['ml_wbid']);
	$data ="";
	if ($result->num_rows > 0) {
       		while($row = $result->fetch_assoc()) {
			$data = $data.$row["id"].",".$row["posX"].",".$row["posY"]."#";
		}
		$data = substr($data,0,-1);
	}
	echo $data;
?>
