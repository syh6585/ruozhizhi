<?php
        require_once '/data/website/libble/pages/class/mysql.class.php';
        $db=new Mysql();
	$taskid = $_GET["taskid"];
	if ($_GET["readonly"] == 1){
		$flag = 1;
	}
	$result=$db->select("Tasks","id=".$taskid);
	$_SESSION["ml_taskid"]=$taskid;
	$task = $result->fetch_assoc();
	$argnames = explode("#",$task["argnames"]);
	$argvals = explode("#",$task["argvals"]);
	$argsps = explode("#",$task["argsps"]);
	$type = $task["class"];
	$num = $task["argnum"];
	//$info = '<form role="form" method="post" action="action/savetask.php?taskid='.$taskid.'"> ';
	$info = '<form id="myForm" role="form" method="post" action="blank.php"> ';
	if ($flag != 1){
		$info = $info.'<div class="form-group"><label>任务名</label><input class="form-control" type="text" id="taskname" value="'.$task["taskname"].'" reqiured></div>';
	 	for ($i=0; $i<$num; $i++) {
			if($argnames[$i]=="input path"){
				$info = $info.'<div class="form-group"><label>'.$argnames[$i].'</label>';
				$info = $info.'<div class="input-group">';
				$info = $info.'<input class="form-control" type="text" id="arg'.$i.'" value="'.$argvals[$i].'" reqiured';
		//	if ($argsps["$i"] == "1") $info = $info.' disabled';
				$info = $info.'>';
				$info = $info.'<span class="input-group-btn"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#newModal"><i class="fa fa-folder-o"></i>';
				$info = $info.'</button></span></div>';
				$info = $info.'</div>';

			}	
			else {
				$info = $info.'<div class="form-group"><label>'.$argnames[$i].'</label><input class="form-control" type="text" id="arg'.$i.'" value="'.$argvals[$i].'" reqiured';
				if ($argsps["$i"] == "1") $info = $info.' disabled';
				$info = $info.'></div>';
			}
		}
		$info = $info.'<div class="form-group"><label>num iters</label><input class="form-control" type="text" id="numIters" value="'.$task["numIters"].'" reqiured></div>';
	}else{
		$info = $info.'<div class="form-group"><label>任务名</label><input class="form-control" type="text" id="taskname" value="'.$task["taskname"].'" reqiured disabled></div>';
	 	for ($i=0; $i<$num; $i++) {	
			if($argnames[$i]=="input path"){
				$info = $info.'<div class="form-group"><label>'.$argnames[$i].'</label>';
				$info = $info.'<div class="input-group">';
				$info = $info.'<input class="form-control" type="text" id="arg'.$i.'" value="'.$argvals[$i].'" reqiured';
		//	if ($argsps["$i"] == "1") $info = $info.' disabled';
				$info = $info.'>';
				$info = $info.'<span class="input-group-btn"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#newModal"><i class="fa fa-folder-o"></i>';
				$info = $info.'</button></span></div>';
				$info = $info.'</div>';

			}
			else {			
			$info = $info.'<div class="form-group"><label>'.$argnames[$i].'</label><input class="form-control" type="text" id="arg'.$i.'" value="'.$argvals[$i].'" reqiured';
			$info = $info.' disabled';
			$info = $info.'></div>';
			}
		}
		$info = $info.'<div class="form-group"><label>num iters</label><input class="form-control" type="text" id="numIters" value="'.$task["numIters"].'" reqiured disabled></div>';
	}
	if ($flag != 1){
		//$info = $info.'<p>';
		$info = $info.'<button type="button" onClick="savetask('.$taskid.','.$num.')" class="btn btn-outline btn-success btn-block"><i class="fa fa-save"></i> 保存任务</button>';
		$info = $info.'<button type="button" class="btn  btn-outline btn-danger btn-block" data-toggle="modal" data-target="#delModal"><i class="fa fa-trash-o"></i> 删除任务</button>';
		$info = $info.'<button type="button" onClick="runtask('.$taskid.')" class="btn btn-outline btn-primary btn-block"><i class="fa fa-play"></i> 运行任务</button>';
		//$info = $info.'</p>';
	}
	if ($task["state"] == "1")  {
		if (($type == 5)||($type == 6)){
			$info = $info.'<button type="button" onClick="window.open(\'view-dl.php?taskid='.$taskid.'\')" class="btn btn-block btn-outline btn-info"><i class="fa fa-bar-chart-o"></i> 查看运行结果</button>';
		}
		else{
			$info = $info.'<button type="button" onClick="window.open(\'view.php?taskid='.$taskid.'\')" class="btn btn-block btn-outline btn-info"><i class="fa fa-bar-chart-o"></i> 查看运行结果</button>';
		}
	}

	$info = $info.'</form>';
	echo $info;

?>
