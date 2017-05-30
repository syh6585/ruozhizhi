<!DOCTYPE html>
<!--html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LIBBLE</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head-->

<!--body onLoad="Autofresh()"-->
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
<div class="modal-header" onLoad="Autofresh()">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h1 class="modal-title">Loss曲线</h1>
</div>
<div class="modal-body">
    <!--p>The content of this modal window has been loaded form a remote source file.</p>
    <p class="text-warning"><small><strong>Note:</strong> This option is deprecated since v3.3.0 and will be removed in v4. Use client-side templating, or a data binding framework, or call jQuery.load yourself instead.</p -->
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
				print("<h1>id=".$_GET['taskid']."</h1>");	
			?>	
    <!--div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="view.php"><strong>LIBBLE</strong></a>
            </div>

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
                </li>
            </ul>

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
                                    
                                </li>
                            </ul>
                            
                        </li>
                    </ul>
                </div>
                
            </div>
    
        </nav>
	</div-->
	<!--*************************************************************** -->
        <div id="wrapper">

	    <!--div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loss曲线</h1>
                </div>
            </div-->		

            <div class="row">
		
		 <div class="col-lg-12">
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
                <!-- /.col-lg-12 -->	

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    <!--/div******************************-->
    <!-- /#wrapper -->

    <!--script src="../vendor/jquery/jquery.min.js"></script>

    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/Chart.js"></script-->

    <script>
	var xmlobj;
	function createXMLHttpRequest(){
		if(window.ActiveXObject){
			xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
		}
		else if(window.XMLHttpRequest){
			xmlobj=new XMLHttpRequest();
		}
	}
	function Autofresh(){
		alert("???");
		createXMLHttpRequest();        
		xmlobj.open("GET","action/read.php?fname="+<?php echo "'".$_GET["taskid"].".txt'"?>,true);
		xmlobj.onreadystatechange=doAjax;
		xmlobj.send("r="+Math.random());
	}		
	function doAjax(){
		if(xmlobj.readyState==4 && xmlobj.status==200){
			var itnum = <?php echo $taskinfo["numIters"]?>;
			//var itnum = 10;
			var bar=document.getElementById('bar');
			var state=document.getElementById('state');
			var label_val = new Array();
			//label_val = ["1","2"];
			var nowdatast = xmlobj.responseText.split(',');
			var nowdata = new Array();
			//nowdata = [0.5,0.7];
			//var percent = 0;
			var batch = 1.0;
			if (itnum>20) batch = itnum/20;
			if (!(xmlobj.responseText == "")){
				for (var i=0;i<nowdatast.length;i++){
					nowdata[i]=parseFloat(nowdatast[i]);
				}
				for (var i=0;i<itnum;i++){
					label_val[i] = i+1;	
				}
				//percent = nowdatast.length*100/itnum;
				if (nowdatast.length == itnum ){
					state.innerHTML='<i class="fa fa-flag fa-fw"></i> 已完成！';
				}
				else{
					state.innerHTML='<i class="fa fa-desktop fa-fw"></i> 计算中...';
				}
			}
			//bar.innerHTML='<div class="progress-bar"  role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: '+ percent +'%"></div>';
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
			var defaults = {
				scaleOverlay : false,
		       		scaleOverride : false,
	       			scaleSteps : null,
	       			scaleStepWidth : null,
	       			scaleStartValue : null,
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
			$('#line').remove();
			$('#linechart').append('<canvas id="line" height = "360"></canvas>');
			var $withd=$("#linechart").width();
			document.getElementById("line").width=$withd*batch;
			new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData,defaults);	
			if ((nowdatast.length > 20 )&&(nowdatast.length < itnum )) document.getElementById('linechart').scrollLeft=(nowdatast.length-20)/itnum*$withd*batch;
			if (nowdatast.length < itnum )setTimeout("Autofresh()",1000);
		}
	}
    </script>
</div>		
<!--/body>

</html-->
