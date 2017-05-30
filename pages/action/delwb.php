<?php
        require_once '/data/website/libble/pages/class/mysql.class.php';
        $db=new Mysql();
	$result=$db->select("Limits","username='".$_SESSION["ml_username"]."' and wbid=".$_GET["wbid"]);
	$row=$result->fetch_assoc();
	$lvl=$row["lvl"];
	if ($lvl==3){
       		$flag = $db->delete("Limits","username='".$_SESSION["ml_username"]."' and wbid=".$_GET["wbid"]);	
	}
	else{
        	$flag1 = $db->delete("Workbench","id=".$_GET["wbid"]);
        	$flag2 = $db->delete("Limits","wbid=".$_GET["wbid"]);
		$result=$db->select("Tasks","username='".$_SESSION["ml_username"]."' and wbid=".$_GET["wbid"]);
		if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
				unlink("/data/website/libble/task/".$row["id"].".txt");
			}
			$db->delete("Tasks","username='".$_SESSION["ml_username"]."' and wbid=".$_GET["wbid"]);
		}
        }
	if ($_GET["wbid"]==$_SESSION["ml_wbid"]){
		unset($_SESSION["ml_wbid"]);
        	unset($_SESSION["ml_taskid"]);
	}
        $url = $_SERVER['HTTP_REFERER'];
	header("Location:".$url);

?>

