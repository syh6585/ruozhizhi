<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		require_once '/data/website/libble/pages/class/mysql.class.php';
		$db=new Mysql();
		$result=$db->select("Workbench","username='".$_SESSION["ml_username"]."' and wbname='".$_POST["wbname"]."'");
		if ($result->num_rows > 0) {
			header("Location:../index.php?alert=-2");
			exit;
		}
		$flag1 = $db->insert("Workbench","(username,wbname)","('".$_SESSION["ml_username"]."','".$_POST["wbname"]."')");
		$flag2 = $db->insert("Limits","(username,wbid,lvl)","('".$_SESSION["ml_username"]."',".$db->lastid().",1)");
	}
	$url = $_SERVER['HTTP_REFERER'];
	header("Location:".$url);

?>
