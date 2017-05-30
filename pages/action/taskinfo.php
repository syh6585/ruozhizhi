<?php
//	ini_set("display_errors","On");  
//	error_reporting(E_ALL); 
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
	//$info = '<form role="form" method="post" action="action/savetask.php?taskid='.$taskid.'"> ';
	$info = '<form id="myForm" role="form" method="post" action="blank.php"> ';
	if ($flag != 1){
		$info = $info.'<div class="form-group"><label>任务名</label><input class="form-control" type="text" id="taskname" value="'.$task["taskname"].'" reqiured></div>';
	 	for ($i=0; $i<count($argnames); $i++) 
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
		else
		{	
			$info = $info.'<div class="form-group"><label>'.$argnames[$i].'</label><input class="form-control" type="text" id="arg'.$i.'" value="'.$argvals[$i].'" reqiured';
			if ($argsps["$i"] == "1") $info = $info.' disabled';
			$info = $info.'></div>';
		}
		$info = $info.'<div class="form-group"><label>num iters</label><input class="form-control" type="text" id="numIters" value="'.$task["numIters"].'" reqiured></div>';
	}else{
		$info = $info.'<div class="form-group"><label>任务名</label><input class="form-control" type="text" id="taskname" value="'.$task["taskname"].'" reqiured disabled></div>';
	for ($i=0; $i<count($argnames); $i++) 
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
			
		else
		{	
			$info = $info.'<div class="form-group"><label>'.$argnames[$i].'</label><input class="form-control" type="text" id="arg'.$i.'" value="'.$argvals[$i].'" reqiured';
			$info = $info.' disabled';
			$info = $info.'></div>';
		}
		$info = $info.'<div class="form-group"><label>num iters</label><input class="form-control" type="text" id="numIters" value="'.$task["numIters"].'" reqiured disabled></div>';
	}
	if ($flag != 1){
		$info = $info.'<p>';
		$info = $info.' <button type="button" onClick="savetask('.$taskid.',11)" class="btn btn-sm btn-outline btn-success"><i class="fa fa-save"></i> 保存</button>';
		$info = $info.' <button type="button" onClick="runtask('.$taskid.',0)" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-play"></i> 运行</button>';
		$info = $info.' <button type="button" class="btn btn-sm btn-outline btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-trash-o"></i> 删除</button>';
	//	$info = $info.' <button type="button" class="btn btn-sm btn-outline btn-danger mytest" data-toggle="modal" data-target="#runModal" title="'.$taskid.'"><i class="fa fa-trash-o"></i> 测试</button>';
		$info = $info.'</p>';
	}
	if ($task["state"] == "1")  $info = $info.'<button type="button" id="mytest" class="btn  btn-sm btn-block btn-outline btn-info mytest"data-toggle="modal" data-target="#runModal" title="'.$taskid.'"><i class="fa fa-bar-chart-o"></i> 查看运行结果</button>';

	$info = $info.'</form>';
	echo $info;

?>
