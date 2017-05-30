<?php
        require_once '/data/website/libble/pages/class/mysql.class.php';
        $db=new Mysql();
        $type = $_GET["type"];
        $id = $_GET["taskid"];
	$result=$db->select("Tasks","id=".$id);
        $task = $result->fetch_assoc();
	$argnames = explode("#",$task["argnames"]);
        $argvals = explode("#",$task["argvals"]);
        $argsps = explode("#",$task["argsps"]);


	$cmd = "/usr/lib/spark-2.0.2-bin-2.6.0/bin/spark-submit --master ".$argvals[0]." --driver-memory ".$argvals[1]."G --executor-memory ".$argvals[2]."G --driver-cores ".$argvals[3]." --total-executor-cores ".$argvals[4]." --class libble.examples.testLR /data/webdata/default/libble-spark_2.11-1.1.0.jar ".$argvals[5]." --elsticF=".$argvals[8]." --numIters=".$task["numIters"]." --stepSize=".$argvals[6]." --regParam=".$argvals[7]." --numPart=".$argvals[9]." --numClasses=".$argvals[10]." > /data/website/libble/task/".$id.".txt &";
	exec($cmd,$output,$val);


	$flag=$db->update("Tasks","state=1","id=".$id);
	$info = '<form id="myForm" role="form" method="post" action="blank.php"> ';
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

		}else	
		{
                $info = $info.'<div class="form-group"><label>'.$argnames[$i].'</label><input class="form-control" type="text" id="arg'.$i.'" value="'.$argvals[$i].'" reqiured';
                if ($argsps["$i"] == "1") $info = $info.' disabled';
                $info = $info.'></div>';
        }
        $info = $info.'<div class="form-group"><label>num iters</label><input class="form-control" type="text" id="numIters" value="'.$task["numIters"].'" reqiured></div>';
        $info = $info.'<p>';
        $info = $info.' <button type="button" onClick="savetask('.$id.',11)" class="btn btn-sm btn-outline btn-success"><i class="fa fa-save"></i> 保存</button>';
        $info = $info.' <button type="button" onClick="runtask('.$id.',0)" class="btn btn-sm btn-outline btn-primary"><i class="fa fa-play"></i> 运行</button>';
        $info = $info.' <button type="button" class="btn btn-sm btn-outline btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-trash-o"></i> 删除</button>';
        $info = $info.'</p>';
        $info = $info.'<button type="button" id="mytest" class="btn  btn-sm btn-block btn-outline btn-info mytest"data-toggle="modal" data-target="#runModal" title="'.$taskid.'"><i class="fa fa-bar-chart-o"></i> 查看运行结果</button>';

$info = $info.'</form>';

	echo $info;

?>

