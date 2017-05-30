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

</head>

<body onLoad="Autofresh()">
	<?php
                if(!isset($_SESSION['ml_username'])) {
                        header("Location:login.php");
                }
		if(!isset($_SESSION['ml_wbid'])) {
			header("Location:index.php");
		}
		if(!isset($_GET['taskid'])) {
			header("Location:index.php");
		}
        ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="view.php"><strong>LIBBLE</strong></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			<?php
				ini_set("display_errors", "On"); 
        			error_reporting(E_ALL | E_STRICT); 

				require_once '/data/website/libble/pages/class/mysql.class.php';
        			$db=new Mysql();
				$result_task=$db->select("Tasks","id=".$_GET['taskid']);
				$taskinfo = $result_task->fetch_assoc();
				if ($taskinfo["wbid"]!=$_SESSION['ml_wbid']){
					header("Location:index.php");
				}
				
			?>	
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
                                            <a href="#">Lasso</a>
                                        </li>
                                        <li>
                                            <a href="#">SVM</a>
                                        </li>
                                        <li>
                                            <a href="#">Ridge Regression</a>
                                        </li>
                                        <li>
                                            <a href="#">Matrix Factorization</a>
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
                <div class="col-lg-6">
                    <h1 class="page-header">Trian Loss</h1>
                    <div class="panel panel-default">
                        <div  class="panel-heading">
                            <span id="state"><i class="fa fa-retweet fa-fw"></i> 准备中...</span>
                        </div>
                        <!-- /.panel-heading -->
                        <div id="linechart" class="panel-body" style="overflow-x: scroll;">
				<canvas id="line" height="360" width="1000"></canvas>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-6">
                    <h1 class="page-header">Validation Accuracy</h1>
                    <div class="panel panel-default">
                        <div  class="panel-heading">
                            <span id="state2"><i class="fa fa-retweet fa-fw"></i> 准备中...</span>
                        </div>
                        <!-- /.panel-heading -->
                        <div id="linechart2" class="panel-body" style="overflow-x: scroll;">
				<canvas id="line2" height="360" width="1000"></canvas>
                        </div>
                        <!-- /.panel-body -->
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
	var xmlobj;
	var old_bar = 0;
	var old_bar2 = 0;
	function createXMLHttpRequest(){
		if(window.ActiveXObject){
			xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else if(window.XMLHttpRequest){
			xmlobj=new XMLHttpRequest();
		}
	}
	function Autofresh(){
		createXMLHttpRequest();        
		xmlobj.open("GET","action/read-dl.php?taskid="+<?php echo $_GET["taskid"] ?>,true);
		xmlobj.onreadystatechange=doAjax;
		xmlobj.send("r="+Math.random());
	}		
	function doAjax(){
		if(xmlobj.readyState==4 && xmlobj.status==200){
			var itnum = <?php echo $taskinfo["numIters"]?>;
			//var itnum = 10;
			var state=document.getElementById('state');
			var state2=document.getElementById('state2');
			var label_val = new Array();
			//label_val = ["1","2"];
			var tt = xmlobj.responseText.split('#');
			//alert(xmlobj.responseText);
			var nowdatast = tt[0].split(',');
			var nowdatast2 = tt[1].split(',');
			//alert(xmlobj.responseText);
			var nowdata = new Array();
			var nowdata2 = new Array();
			//nowdata = [0.7908,0.6,0.6];
			//var percent = 0;
			var batch = 1.0;
			if (itnum>10) batch = itnum/10;
			if (!(xmlobj.responseText == "")){
				for (var i=0;i<nowdatast.length;i++){
					nowdata[i]=parseFloat(nowdatast[i]);
					nowdata2[i]=parseFloat(nowdatast2[i]);
				}
				for (var i=0;i<itnum;i++){
					label_val[i] = i+1;	
				}
				//percent = nowdatast.length*100/itnum;
				if (nowdatast.length >= itnum ){
					state.innerHTML='<i class="fa fa-flag fa-fw"></i> 已完成！';
					state2.innerHTML='<i class="fa fa-flag fa-fw"></i> 已完成！';
				}
				else{
					state.innerHTML='<i class="fa fa-desktop fa-fw"></i> 计算中...';
					state2.innerHTML='<i class="fa fa-desktop fa-fw"></i> 计算中...';
				}
			}
			//bar.innerHTML='<div class="progress-bar"  role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+ percent +'%"></div>';
			//alert(nowdata);
			var lineChartData = {
				labels : label_val,
				datasets : [
					 {
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
	   					pointColor : "rgba(151,187,205,1)",
	  					pointStrokeColor : "#fff",
	    					data : nowdata
	 				}

	 			]
			};	
			var lineChartData2 = {
				labels : label_val,
				datasets : [
					 {
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
	   					pointColor : "rgba(151,187,205,1)",
	  					pointStrokeColor : "#fff",
	    					data : nowdata2
	 				}

	 			]
			};	
			var defaults = {
				scaleOverlay : false,
		       		scaleOverride : false,
	       			scaleSteps : 10,
	       			scaleStepWidth : 0.1,
	       			scaleStartValue : 0,
				scaleLineColor : "rgba(0,0,0,.1)",
				scaleLineWidth : 1,
				scaleShowLabels : true,
				scaleLabel : "<%=value%>",
				scaleFontFamily : "'Arial'",
				scaleFontSize : 12,
				scaleFontStyle : "normal",
				scaleFontColor : "#666",
				scaleShowGridLines : true,
				scaleGridLineColor : "rgba(0,0,0,.05)",
				scaleGridLineWidth : 1,
				bezierCurve : true,
				pointDot : true,
				pointDotRadius : 4,
				pointDotStrokeWidth : 2,
				datasetStroke : true,
				datasetStrokeWidth : 2,
				datasetFill : true,
				animation : false,
				animationSteps : 60,
				animationEasing : "easeOutQuart",
				onAnimationComplete : null
			};
			old_bar = document.getElementById('linechart').scrollLeft;
			//alert(old_bar);
			$('#line').remove();
			$('#linechart').append('<canvas id="line" height = "360"></canvas>');
			var $withd=$("#linechart").width();
			document.getElementById("line").width=$withd*batch;
			new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData,defaults);	
			document.getElementById('linechart').scrollLeft = old_bar;
			//if ((nowdatast.length > 10 )&&(nowdatast.length < itnum )) document.getElementById('linechart').scrollLeft=(nowdatast.length-10)/itnum*$withd*batch;
			old_bar2 = document.getElementById('linechart2').scrollLeft;
			$('#line2').remove();
			$('#linechart2').append('<canvas id="line2" height = "360"></canvas>');
			var $withd=$("#linechart2").width();
			document.getElementById("line2").width=$withd*batch;
			new Chart(document.getElementById("line2").getContext("2d")).Line(lineChartData2,defaults);	
			document.getElementById('linechart2').scrollLeft = old_bar2;
			//if ((nowdatast.length > 10 )&&(nowdatast.length < itnum )) document.getElementById('linechart2').scrollLeft=(nowdatast.length-10)/itnum*$withd*batch;
			if (nowdatast.length < itnum )setTimeout("Autofresh()",1000);
		}
	}
    </script>
		
</body>

</html>
