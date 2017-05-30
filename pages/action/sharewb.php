<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                require_once '/data/website/libble/pages/class/mysql.class.php';
                $db=new Mysql();
		$result=$db->select("Users","username='".$_POST["username"]."'");
		if ($result->num_rows==0){
			$url = "../index.php?alert=1";
		        header("Location:".$url);
			exit;
		}
		$result=$db->select("Limits","username='".$_POST["username"]."' and wbid=".$_POST["wbid"]);
		if ($result->num_rows>0){
			$url = "../index.php?alert=2";
		        header("Location:".$url);
			exit;
		}
		if ($_POST["limits"] == "查看"){
			$lvl=3;
		}
		else {
			$lvl=2;
		}
		$flag = $db->insert("Limits","(username,wbid,lvl)","('".$_POST["username"]."',".$_POST["wbid"].",".$lvl.")");
	}
	$url = "../index.php?alert=-1";
        header("Location:".$url);
?>

