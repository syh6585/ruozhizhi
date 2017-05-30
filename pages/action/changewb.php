<?php
	$_SESSION["ml_wbid"]=$_GET['wbid'];
	//$url = $_SERVER['HTTP_REFERER'];
	require_once '/data/website/libble/pages/class/mysql.class.php';
        $db=new Mysql();
	$result=$db->select("Limits","username='".$_SESSION['ml_username']."' and wbid=".$_SESSION['ml_wbid']);
	$row = $result->fetch_assoc();
	if ($row["lvl"]==3){
		header("Location:../draw-onlyread.php");
	}else{
		header("Location:../draw.php");
	}
?>
