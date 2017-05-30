<?php
//	echo "jinru jiaoben";
	$ssh_ip = $argv[1];
	$ssh_port = $argv[2];
	$ssh_user = $argv[3];
	$ssh_key = $argv[4];
	$result_file = $argv[5];
	$result_on_server = $argv[6];
	$cmd_file_name = $argv[7];

	set_time_limit(0);

	$cmd_file = fopen($cmd_file_name, 'r');
	$cmd = fgets($cmd_file);
	echo $cmd;
	fclose($cmd_file);

	$connection = ssh2_connect($ssh_ip, $ssh_port);
	ssh2_auth_password($connection, $ssh_user, $ssh_key);
	$stream = ssh2_exec($connection, $cmd);
	stream_set_blocking($stream, true);
	$output = stream_get_contents($stream);
//	$fclose($stream);
	
//	echo "likai jiaoben";

	//fetch result file from gpu cluster
	//ssh2_scp_recv($connection, $result_on_server, $result_local);
//	$sftp = ssh2_sftp($connection);
//	$srcFile = fopen("ssh2.sftp://{$sftp}".$result_on_server, 'r');
//	/$resFile = fopen($result_file, 'w');
//	while( $chunk = fread($srcFile, 8192)) {
//	        fwrite($resFile, $chunk);
//		sleep(10);
 //	}
//	fclose($resFile);
//	fclose($srcFile);

//	$stdio_stream = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
//	stream_set_blocking($stdio_stream, true);
//	$result = stream_get_contents($stdio_stream);
//	$file = fopen($result_file, "w");
	//fwrite($file, $result);
	//fclose($stdio_stream);
	//fclose($file);


//	while(!feof($result)){
//		$line = fread($result);
//		fwrite($file, $line);
//		sleep(2);
//	}
//
	fclose($stream);
//	fclose($stdio_stream);
//	fclose($file);
	
?>
