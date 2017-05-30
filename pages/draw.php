<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LIBBLE</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="../vendor/new/hadoop.css"> 
    <link rel="stylesheet" href="../vendor/new/jquery-ui.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style> 
	.draw{height:450px} 
	.list{height:480px} 
	#delModal{
		z-index:100000
	}
	#newModal{
		z-index:100000
	}
    </style>

</head>

<?php if(!isset($_SESSION['ml_wbid'])) { ?>
<body>
<?php }else{ ?>	
<body onload="loadbtn()">
<?php } ?>	
	<?php
                if(!isset($_SESSION['ml_username'])) {
                        header("Location:login.php");
                }
        ?>
	<?php
                if(!isset($_SESSION['ml_wbid'])) {
                        header("Location:index.php");
                }
		require_once '/data/website/libble/pages/class/mysql.class.php';
        	$db=new Mysql();
		$result1=$db->select("Limits","username='".$_SESSION['ml_username']."' and wbid=".$_SESSION['ml_wbid']);
		$row1 = $result1->fetch_assoc();
		if ($row1["lvl"]==3){
			header("Location:index.php");
		}	
        ?>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="draw.php"><strong>LIBBLE</strong></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right"> 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> 用户信息</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> 账号设置</a>
                        </li>
                        <li class="divider"></li>
                        <li><a class="text-center" href="action/logout.php"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="搜索...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> 特征工程<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">待开发...</a>
                                </li>
                                <li>
                                    <a href="#">待开发...</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> 机器学习<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">浅层学习 <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a onmousedown = "show(0);">Logistic Regression</a>
                                        </li>
                                        <li>
                                            <a onmousedown = "show(1);">Lasso</a>
                                        </li>
                                        <li>
                                            <a onmousedown = "show(2);">SVM</a>
                                        </li>
                                        <li>
                                            <a onmousedown = "show(3);">Ridge Regression</a>
                                        </li>
                                        <li>
                                            <a onmousedown = "show(4);">Matrix Factorization</a>
                                        </li>
                                        <li>
                                            <a href="#">待开发...</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">深度学习 <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a onmousedown = "show(5);">AlexNet</a>
                                        </li>
                                        <li>
                                            <a onmousedown = "show(6);">RNN</a>
                                        </li>
                                        <li>
                                            <a href="#">待开发...</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

	    <!-- Modal -->
            <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">删除任务</h4>
                                </div>
                                <div class="modal-body">
                                        确定要删除吗？
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <button type="button" onClick="deltask()" class="btn btn-primary" data-dismiss="modal">确认</button>
                                </div>
                        </div>
                        <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


		    //浏览文件的窗口
		    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" >
					<div class="modal-content"style="width:800px;height:500px">
						<div class="modal-header" style="height:40px;">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h5 class="modal-title" id="myModalLabel">浏览</h5>
						 </div>

    					<div class="container"style="width:100%;height:90%;">

							<div class="row" style="width:100%;margin:0 auto;">
								<form onsubmit="return false;" text-align="center">
									<div class="input-group">
										<span class="input-group-btn">
											<button class="btn btn-default"
															id="bkwd" onclick="javascript:history.go(-1);">
												<img src="../vendor/new/Left4.png"width="16"/>
											</button>
											<button class="btn btn-default"
															id="fwd" onclick="javascript:history.go(1);">
												<img src="../vendor/new/Right4.png"width="16"/>
											</button>
											<button class="btn btn-default"
															id="uwd">
												<img src="../vendor/new/Up4.png"width="16"/>
											</button>
										</span>
										<input type="text" class="form-control" id=
						"directory" style="width:80%" /> <!--span class="input-group-btn"-->
										<button class="btn btn-default"
													type="submit" id="btn-nav-directory" >Go!
										</button><!--/span-->
									</div>
								</form>
							</div>
      
							<div class="input-group"></div>
							<br />
      							<div id="panel"style="width:100%;height:70%;overflow:auto;">
		
		
							</div>

							<div class="row" style="width:100%">
			
								<div class="input-group" style="text-align:right;margin-top:10px;">
									<span class="input-group-btn">
										<button class="btn btn-info"
														id="choosedir">确定
										</button>
									</span>
								</div>
			<!--div class="col-xs-2"><p>Hadoop, 2016.</p></div-->
			
							</div>

   		 				</div>

						<script type="text/x-dust-template" id="tmpl-explorer">
							<table class="table" id="tab">
								<thead>
									<tr>
										<th>Name</th>
										<th>Permission</th>
										<th>Owner</th>
										<th>Group</th>
										<th>Size</th>
										<th>Last Modified</th>

										
									</tr>
								</thead>
								<tbody>
									{#FileStatus}
									<tr  class="browse-file-new" inode-type="{type}" inode-path="{pathSuffix}">
										<td><a style="cursor:pointer" inode-type="{type}" class="explorer-browse-links" inode-path="{pathSuffix}">{pathSuffix}</a></td>
										<td>{type|helper_to_directory}{permission|helper_to_permission}{aclBit|helper_to_acl_bit}</td>
										<td>{owner}</td>
										<td>{group}</td>
										<td>{length|fmt_bytes}</td>
										<td>{#helper_date_tostring value="{modificationTime}"/}</td>

									</tr>
									{/FileStatus}
								</tbody>
							</table>
						</script>

						<script type="text/x-dust-template" id="tmpl-block-info">
							{#block}
								<p>Block ID: {blockId}</p>
								<p>Block Pool ID: {blockPoolId}</p>
								<p>Generation Stamp: {generationStamp}</p>
								<p>Size: {numBytes}</p>
							{/block}
							<p>Availability:
								<ul>
								{#locations}
								<li>{hostName}</li>
								{/locations}
								</ul>
							</p>
						</script>

					</div>
				</div>
			</div>





            <div class="row">
				<?php	
					$result=$db->select("Workbench","id=".$_SESSION['ml_wbid']);
					$wb = $result->fetch_assoc();
				?>
			<br>	
			<div class="col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-dashboard fa-fw"></i> 任务布局
			</div>
 			<div class="panel-body">
			    <div class="draw" id = "mydraw"></div>	
                        </div>

		    </div>
		</div>
	
		<div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
			
                            <i class="fa fa-tasks fa-fw"></i> 工作台：<?php echo $wb["wbname"]?>
			    <a href="index.php" type="button" class="btn btn-default btn-xs pull-right">
                                 <i class="fa fa-cog"></i>
                            </a>
			</div>
			<div class="panel-body list" style="overflow-y: scroll;" id = "info">
			</div>
		    </div>
		</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/Chart.js"></script>
    <script type="text/javascript" src="../vendor/new/dust-full-2.0.0.min.js">
    </script><script type="text/javascript" src="../vendor/new/dust-helpers-1.1.1.min.js">
    </script><script type="text/javascript" src="../vendor/new/dfs-dust.js">
    </script><script type="text/javascript" src="../vendor/new/explorer.js">
    </script><script type="text/javascript" src="../vendor/new/jquery-ui.min.js">
    </script>

    <script>
	        
    	mydraw = document.getElementById('mydraw');
	drawl = getLeft(mydraw);
	drawr = drawl + mydraw.offsetWidth;
	drawt = getTop(mydraw);
	drawd = drawt + mydraw.offsetHeight;


	var xmlobj;
	function createXMLHttpRequest(){
		if(window.ActiveXObject){
			xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else if(window.XMLHttpRequest){
			xmlobj=new XMLHttpRequest();
		}
	}



	function show(type){

		isFirst = type;

		var tip = document.createElement('input');
		tip.type = "button";
		if (type == 0){
			tip.value = "Logistic Regression";
		}
		if (type == 1){
			tip.value = "Lasso";
		}
		if (type == 2){
			tip.value = "SVM";
		}
		if (type == 3){
			tip.value = "Ridge Regression";
		}
		if (type == 4){
			tip.value = "Matrix Factorization";
		}
		if (type == 5){
			tip.value = "AlexNet";
		}
		if (type == 6){
			tip.value = 'RNN';
		}

		tip.className = "btn  btn-default"
		tip.style.position = "absolute";

		tip.style.zIndex = "99999";
		tip.onmousedown = grabber;

		document.getElementsByTagName('body')[0].appendChild(tip);
		tip.style.top = window.event.clientY - tip.offsetHeight/2 + "px";
		tip.style.left = window.event.clientX - tip.offsetWidth/2 + "px";
		width = tip.offsetWidth;
		height = tip.offsetHeight;

		theElement = tip;
		var posX = parseInt(theElement.style.left);
		var posY = parseInt(theElement.style.top);

		diffX = event.clientX - posX;
		diffY = event.clientY - posY;


		document.addEventListener("mousemove", mover, true);
		document.addEventListener("mouseup", dropper, true);
		event.stopPropagation();
		event.preventDefault();
	}

	function grabber(event) {
		isFirst = -1;
		
		theElement = event.currentTarget;

		createXMLHttpRequest();        
		xmlobj.open("GET","action/taskinfo.php?taskid="+theElement.id,true);
		xmlobj.onreadystatechange= taskinfo;
		xmlobj.send("r="+Math.random());
				
		width = theElement.offsetWidth;
		height = theElement.offsetHeight;

		var posX = parseInt(theElement.style.left);
		var posY = parseInt(theElement.style.top);


		diffX = event.clientX - posX;//左侧距离
		diffY = event.clientY - posY;

		//diffX_init = diffX;
		//diffY_init = diffY;

		document.addEventListener("mousemove", mover, true);
		document.addEventListener("mouseup", dropper, true);
	

		event.stopPropagation();
		event.preventDefault();
	}

	function mover(event) {
		var newX = event.clientX-diffX;
		var newY = event.clientY-diffY;
		//var oldX = parseInt(theElement.style.left);
		//var oldY = parseInt(theElement.style.top);


		if (isFirst==-1){
			if (newX < drawl){
				newX = drawl;
			}
			if (newX + width > drawr){
				newX = drawr - width;
			}
			if (newY < drawt){
				newY = drawt;
			}
			if (newY + height > drawd){
				newY = drawd - height;
			}
		}
			
		theElement.style.left = newX + "px";
		theElement.style.top = newY + "px";

		event.stopPropagation();
		event.preventDefault();
	}

	function dropper(event) {

		if(isFirst>=0) {
			if(event.clientX-diffX >= drawl && event.clientX-diffX+width <= drawr && event.clientY-diffY >= drawt && event.clientY-diffY+height <= drawd) {
				var posX = parseInt(theElement.style.left);
				var posY = parseInt(theElement.style.top);
				createXMLHttpRequest();        
				xmlobj.open("GET","action/newtask.php?posX="+(posX-drawl)/(mydraw.offsetWidth-width)+"&posY="+posY+"&type="+isFirst,true);
				xmlobj.onreadystatechange=newtask;
				xmlobj.send("r="+Math.random());				
				isFirst = -1;
			}
			else {
				document.getElementsByTagName('body')[0].removeChild(theElement);
			}
		}
		else {
			var posX = parseInt(theElement.style.left);
			var posY = parseInt(theElement.style.top);
			var taskid = theElement.id;
			createXMLHttpRequest();        
			xmlobj.open("GET","action/postask.php?posX="+(posX-drawl)/(mydraw.offsetWidth-width)+"&posY="+posY+"&taskid="+taskid,true);
			xmlobj.onreadystatechange= function(){ }
			xmlobj.send("r="+Math.random());				
			
		}

		document.removeEventListener("mouseup", dropper, true);
		document.removeEventListener("mousemove", mover, true);

		event.stopPropagation();
		event.preventDefault();
	}
		
	function getTop(e){ 
		var offset=e.offsetTop; 
		if(e.offsetParent!=null) offset+=getTop(e.offsetParent); 
		return offset; 
	} 

	function getLeft(e){ 
		var offset=e.offsetLeft; 
		if(e.offsetParent!=null) offset+=getLeft(e.offsetParent); 
		return offset; 
	}
	function newtask(){
		if(xmlobj.readyState==4 && xmlobj.status==200){
			theElement.id = xmlobj.responseText;
		}
 	}
	function savetask(id,num){
		var data = "";
		var taskname = document.getElementById("taskname").value;
		var numIters = document.getElementById("numIters").value;
		data += document.getElementById("arg0").value;
		for (var i=1;i<num;i++){
			data += "*" + document.getElementById("arg"+i).value;
		}
		//alert(id);
		createXMLHttpRequest();        
		xmlobj.open("GET","action/savetask.php?taskid="+id+"&taskname="+taskname+"&numIters="+numIters+"&data="+data,true);
		xmlobj.onreadystatechange= function(){ }
		xmlobj.send("r="+Math.random());				
	}
	function runtask(id){	
		createXMLHttpRequest();        
		xmlobj.open("GET","action/runtask.php?taskid="+id,true);
		xmlobj.onreadystatechange= taskinfo;
		xmlobj.send("r="+Math.random());				
	}
	function taskinfo(){
		document.getElementById("info").innerHTML = xmlobj.responseText;
	}
	function deltask(){
		createXMLHttpRequest();        
		xmlobj.open("GET","action/deltask.php",true);
		xmlobj.onreadystatechange= function(){ }
		xmlobj.send("r="+Math.random());				
		document.getElementById("info").innerHTML = "";
		document.getElementsByTagName('body')[0].removeChild(theElement);
	}
	function loadbtn(){		
		createXMLHttpRequest();        
		xmlobj.open("GET","action/loadtask.php",true);
		xmlobj.onreadystatechange= loadtask;
		xmlobj.send("r="+Math.random());				
	}
	function loadtask(){
		if(xmlobj.readyState==4 && xmlobj.status==200){
    			mydraw = document.getElementById('mydraw');
			drawl = getLeft(mydraw);
			drawr = drawl + mydraw.offsetWidth;
			drawt = getTop(mydraw);
			drawd = drawt + mydraw.offsetHeight;
			if (xmlobj.responseText.length== 1) return;
			var tasks = xmlobj.responseText.split('#');
			for (var i=0;i<tasks.length;i++){
				var info = tasks[i].split(',');
				isFirst = -1;

				var tip = document.createElement('input');
				tip.type = "button";
				if (info[3] == 0){
					tip.value = "Logistic Regression";
				}
				if (info[3] == 1){
					tip.value = "Lasso";
				}
				if (info[3] == 2){
					tip.value = "SVM";
				}
				if (info[3] == 3){
					tip.value = "Ridge Regression";
				}
				if (info[3] == 4){
					tip.value = "Matrix Factorization";
				}
				if (info[3] == 5){
					tip.value = "AlexNet";
				}
				if (info[3] == 6){
					tip.value = "RNN";
				}
				tip.className = "btn  btn-default"
				tip.style.position = "absolute";
				tip.id = info[0];

				tip.style.zIndex = "99999";
				tip.onmousedown = grabber;

				document.getElementsByTagName('body')[0].appendChild(tip);
				width = tip.offsetWidth;
				height = tip.offsetHeight;
				tip.style.top = info[2] + "px";
				var t = Math.round(parseFloat(info[1])*(mydraw.offsetWidth-width) + drawl);
				tip.style.left = t + "px";
				//document.getElementById("mydraw").innerHTML += "<span>"+t+" </span>";
				theElement = tip;
				var posX = parseInt(theElement.style.left);
				var posY = parseInt(theElement.style.top);

				diffX = event.clientX - posX;
				diffY = event.clientY - posY;


				document.addEventListener("mousemove", mover, true);
				document.addEventListener("mouseup", dropper, true);
				event.stopPropagation();
				event.preventDefault();

			}
			theElement = null;
		}
	}

    </script>
	
	
</body>

</html>
