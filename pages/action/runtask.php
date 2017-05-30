<?php
        require_once '/data/website/libble/pages/class/mysql.class.php';
        $db=new Mysql();
        $id = $_GET["taskid"];
	$result=$db->select("Tasks","id=".$id);
        $task = $result->fetch_assoc();
        $type = $task["class"];
	$argnames = explode("#",$task["argnames"]);
        $argvals = explode("#",$task["argvals"]);
        $argsps = explode("#",$task["argsps"]);
	$num = $task["argnum"];
	$if_ssh = false;

	if ($type == 0){
		$cmd = "/usr/lib/spark-2.0.2-bin-2.6.0/bin/spark-submit --master ".$argvals[0]." --driver-memory ".$argvals[1]."G --executor-memory ".$argvals[2]."G --driver-cores ".$argvals[3]." --total-executor-cores ".$argvals[4]." --class libble.examples.testLR /data/webdata/default/libble-spark_2.11-1.1.0.jar ".$argvals[5]." --elsticF=".$argvals[8]." --numIters=".$task["numIters"]." --stepSize=".$argvals[6]." --regParam=".$argvals[7]." --numPart=".$argvals[9]." --numClasses=".$argvals[10]." > /data/website/libble/task/".$id.".txt &";

	}
	if ($type == 1){
		$cmd = "/usr/lib/spark-2.0.2-bin-2.6.0/bin/spark-submit --master ".$argvals[0]." --driver-memory ".$argvals[1]."G --executor-memory ".$argvals[2]."G --driver-cores ".$argvals[3]." --total-executor-cores ".$argvals[4]." --class libble.examples.testLasso /data/webdata/default/libble-spark_2.11-1.1.0.jar ".$argvals[5]." --elsticF=".$argvals[8]." --numIters=".$task["numIters"]." --stepSize=".$argvals[6]." --regParam=".$argvals[7]." --numPart=".$argvals[9]." > /data/website/libble/task/".$id.".txt &";

	}
	if ($type == 2){
		$cmd = "/usr/lib/spark-2.0.2-bin-2.6.0/bin/spark-submit --master ".$argvals[0]." --driver-memory ".$argvals[1]."G --executor-memory ".$argvals[2]."G --driver-cores ".$argvals[3]." --total-executor-cores ".$argvals[4]." --class libble.examples.testSVM /data/webdata/default/libble-spark_2.11-1.1.0.jar ".$argvals[5]." --elsticF=".$argvals[8]." --numIters=".$task["numIters"]." --stepSize=".$argvals[6]." --regParam=".$argvals[7]." --numPart=".$argvals[9]." > /data/website/libble/task/".$id.".txt &";

	}
	if ($type == 3){
		$cmd = "/usr/lib/spark-2.0.2-bin-2.6.0/bin/spark-submit --master ".$argvals[0]." --driver-memory ".$argvals[1]."G --executor-memory ".$argvals[2]."G --driver-cores ".$argvals[3]." --total-executor-cores ".$argvals[4]." --class libble.examples.testRR /data/webdata/default/libble-spark_2.11-1.1.0.jar ".$argvals[5]." --elsticF=".$argvals[8]." --numIters=".$task["numIters"]." --stepSize=".$argvals[6]." --regParam=".$argvals[7]." --numPart=".$argvals[9]." > /data/website/libble/task/".$id.".txt &";

	}
	if ($type == 4){
		$cmd = "/usr/lib/spark-2.0.2-bin-2.6.0/bin/spark-submit --master ".$argvals[0]." --driver-memory ".$argvals[1]."G --executor-memory ".$argvals[2]."G --driver-cores ".$argvals[3]." --total-executor-cores ".$argvals[4]." --class libble.examples.testCF /data/webdata/default/libble-spark_2.11-1.1.0.jar ".$argvals[5]." --numIters=".$task["numIters"]." --stepSize=".$argvals[6]." --regParam_u=".$argvals[7]." --regParam_v=".$argvals[8]." --rank=".$argvals[9]." --numPart=".$argvals[10]." --ifPrintLoss=1 > /data/website/libble/task/".$id.".txt &";

	}
	if ($type == 5){
		$result_on_server = "/home/cheny/cnn_for_remote/".$id.".txt";
		$result_on_client = "/data/website/libble/task/".$id.".txt";
//		$cmd = "~/cnn_for_remote_call.link -training_home=".$argvals[0]." -save_name=".$argvals[1]." -gpu_no=".$argvals[2]." -learning_rate=".$argvals[3]." -training_eps=".$task["numIters"]." -batch_size=".$argvals[4]." > ".$result_on_server."; scp ".$result_on_client." root@114.212.189.79:".$result_on_client;
		//echo $cmd;
		$cmd = "~/cnn_for_remote_call.link -training_home=".$argvals[0]." -save_name=".$argvals[1]." -gpu_no=".$argvals[2]." -learning_rate=".$argvals[3]." -training_eps=".$task["numIters"]." -batch_size=".$argvals[4]." > ".$result_on_server." &";
		$send_cmd = "sh ~/scp_result_to_cpu.sh ".$id." ".$task["numIters"]." &";
		//echo $cmd;
		//$cmd_file = fopen('runcmd.txt', 'w');
		//fwrite($cmd_file, $cmd);
		$ssh_ip="114.212.189.63";
		$ssh_port=22;
		$ssh_user="cheny";
		$ssh_key="123456";
		$if_ssh=true;
	}
	if ($type == 6){
		$result_on_server = "/home/xud/Music/rnnForClassification/rnn_for_remote/".$id.".txt";
		$result_on_client = "/data/website/libble/task/".$id.".txt";
//		$cmd = "~/Music/rnnForClassification/rnn_for_remote.link -save_name=".$argvals[1]." -gpu_no=".$argvals[2]." -learning_rate=".$argvals[3]." -batch_size=".$argvals[4]." -keep_prob=".$argvals[5]." -keep_input_prob=".$argvals[6]." -training_eps=".$task["numIters"]." > ".$result_on_server." &; scp ".$result_on_server." root@114.212.189.79:".$result_on_client;

		$cmd = "~/Music/rnnForClassification/rnn_for_remote.link -save_name=".$argvals[1]." -gpu_no=".$argvals[2]." -learning_rate=".$argvals[3]." -batch_size=".$argvals[4]." -keep_prob=".$argvals[5]." -keep_input_prob=".$argvals[6]." -training_eps=".$task["numIters"]." > ".$result_on_server." &";
		$send_cmd = "sh ~/Music/rnnForClassification/rnn_for_remote/scp_result_to_cpu.sh ".$id." &";
		$ssh_ip="114.212.189.63";
		$ssh_port=22;
		$ssh_user="xud";
		$ssh_key="dc.swind";
		$if_ssh=true;
	}

	if ($if_ssh){
		//echo "运行脚本前";
//		$sshcmd = "php sshgpu.php ".$ssh_ip." ".$ssh_port." ".$ssh_user." ".$ssh_key." ".$result_on_client." ".$result_on_server." runcmd.txt &";
//		echo $sshcmd;
//		shell_exec($sshcmd);
		//echo "运行脚本后";
		//echo $cmd;	
		//echo $send_cmd;
		set_time_limit(0);
		$connection = ssh2_connect($ssh_ip, $ssh_port);
		ssh2_auth_password($connection, $ssh_user, $ssh_key);
		$gpu_exec = ssh2_exec($connection, $cmd);
		stream_set_blocking($gpu_exec, true);
		$gpu_send = ssh2_exec($connection, $send_cmd);
		stream_set_blocking($gpu_send, true);
//		$output = stream_get_contents($stream);
		fclose($gpu_exec);
		fclose($gpu_send);
	}
	else{
		exec($cmd,$output,$val);
	}




	$flag=$db->update("Tasks","state=1","id=".$id);
	$info = '<form id="myForm" role="form" method="post" action="blank.php"> ';
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
        //$info = $info.'<p>';
        $info = $info.' <button type="button" onClick="savetask('.$id.','.$num.')" class="btn btn-block btn-outline btn-success"><i class="fa fa-save"></i> 保存任务</button>';
        $info = $info.' <button type="button" class="btn btn-block btn-outline btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-trash-o"></i> 删除任务</button>';
        $info = $info.' <button type="button" onClick="runtask('.$id.')" class="btn btn-block btn-outline btn-primary"><i class="fa fa-play"></i> 运行任务</button>';
        //$info = $info.'</p>';
	if (($type == 5)||($type == 6)){
		$info = $info.'<button type="button" onClick="window.open(\'view-dl.php?taskid='.$id.'\')" class="btn btn-block btn-outline btn-info"><i class="fa fa-bar-chart-o"></i> 查看运行结果</button>';
	}
	else{
		$info = $info.'<button type="button" onClick="window.open(\'view.php?taskid='.$id.'\')" class="btn btn-block btn-outline btn-info"><i class="fa fa-bar-chart-o"></i> 查看运行结果</button>';
	}
        $info = $info.'</form>';

	echo $info;

?>

