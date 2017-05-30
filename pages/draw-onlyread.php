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
                                            <a href="#">Logistic Regression</a>
                                        </li>
                                        <li>
                                            <a href="#">待开发...</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">深层学习 <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">待开发...</a>
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

            <div class="row">
	<?php	
		require_once '/data/website/libble/pages/class/mysql.class.php';
        	$db=new Mysql();
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
    <script>
    	mydraw = document.getElementById('mydraw');
	drawl = getLeft(mydraw);
	drawr = drawl + mydraw.offsetWidth;
	drawt = getTop(mydraw);
	drawd = drawt + mydraw.offsetHeight;
	//document.getElementById("mydraw").innerHTML += "<span>"+drawl+" </span>";
	//document.getElementById("mydraw").innerHTML += "<span>"+drawr+" </span>";
	//document.getElementById("mydraw").innerHTML += "<span>"+drawt+" </span>";
	//document.getElementById("mydraw").innerHTML += "<span>"+drawd+" </span>";
	//var pos = document.getElementById('lr');
	//document.getElementById("mydraw").innerHTML += "<span>"+getTop(pos)+"  </span>";
	//document.getElementById("mydraw").innerHTML += "<span>"+getLeft(pos)+"  </span>";

	var xmlobj;
	function createXMLHttpRequest(){
		if(window.ActiveXObject){
			xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else if(window.XMLHttpRequest){
			xmlobj=new XMLHttpRequest();
		}
	}


	function grabber(event) {
		isFirst = false;
		
		theElement = event.currentTarget;

		createXMLHttpRequest();        
		xmlobj.open("GET","action/taskinfo.php?taskid="+theElement.id+"&readonly=1",true);
		xmlobj.onreadystatechange= taskinfo;
		xmlobj.send("r="+Math.random());
				
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
	function taskinfo(){
		document.getElementById("info").innerHTML = xmlobj.responseText;
	}
	function loadbtn(){		
		createXMLHttpRequest();        
		xmlobj.open("GET","action/loadtask.php",true);
		xmlobj.onreadystatechange= loadtask;
		xmlobj.send("r="+Math.random());				

	}
	function loadtask(){
		if(xmlobj.readyState==4 && xmlobj.status==200){
			if (xmlobj.responseText.length== 1) return;
			var tasks = xmlobj.responseText.split('#');
			for (var i=0;i<tasks.length;i++){
				var info = tasks[i].split(',');
				isFirst = true;

				var tip = document.createElement('input');
				tip.type = "button";
				tip.value = "Logistic Regression";
				tip.className = "btn  btn-default"
				tip.style.position = "absolute";
				tip.id = info[0];

				tip.style.zIndex = "99999";
				tip.onmousedown = grabber;

				document.getElementsByTagName('body')[0].appendChild(tip);
				tip.style.top = info[2] + "px";
				var t = Math.round(parseFloat(info[1])*mydraw.offsetWidth + drawl);
				tip.style.left = t + "px";
				//document.getElementById("mydraw").innerHTML += "<span>"+t+" </span>";
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
			theElement = null;
		}
	}

    </script>
	
	
</body>

</html>
