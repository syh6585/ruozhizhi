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
        .draw{height:480px}
    </style>

</head>

<body>
	<?php
                if(!isset($_SESSION['ml_username'])) {
                        header("Location:login.php");
                }
        ?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><strong>LIBBLE</strong></a>
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
		$result=$db->select("Limits","username='".$_SESSION['ml_username']."'");
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>

	    <!-- Modal -->
	    <div class="modal fade" id="delWB<?php echo $row["wbid"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
	    			<div class="modal-header">
	    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    				<h4 class="modal-title" id="myModalLabel">删除工作台</h4>
	    			</div>
	    			<div class="modal-body">
					确定要删除吗？
	    			</div>
	    			<div class="modal-footer">
	    				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	    				<a href="<?php echo "action/delwb.php?wbid=".$row["wbid"] ?>"><button type="button" class="btn btn-primary">确认</button></a>
	    			</div>
			</div>
	    		<!-- /.modal-content -->
	    	</div>
	    	<!-- /.modal-dialog -->
	    </div>
	    <!-- /.modal -->

	    <!-- Modal -->
	    <div class="modal fade" id="shareWB<?php echo $row["wbid"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
	    			<div class="modal-header">
	    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    				<h4 class="modal-title" id="myModalLabel">共享工作台</h4>
	    			</div>
				<form role="form" action="action/sharewb.php" method="post">
	    			<div class="modal-body">
					<div class="form-group input-group">
						<span class="input-group-addon">@</span>
                                                <input class="form-control" placeholder="共享对象用户名" name="username" type="text" required>
                                        </div>
					<div class="form-group input-group">
					    <span class="input-group-addon">共享权限</span>
                                            <select class="form-control" name="limits">
                                                <option>查看</option>
                                                <option>完全共享</option>
                                            </select>
                                        </div>
					<input type="hidden" name="wbid" value="<?php echo $row["wbid"]?>"> 
	    			</div>
	    			<div class="modal-footer">
	    				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
	    				<button type="submit" class="btn btn-primary">确认</button>
	    			</div>
				</form>
			</div>
	    		<!-- /.modal-content -->
	    	</div>
	    	<!-- /.modal-dialog -->
	    </div>
	    <!-- /.modal -->
	<?php
			}
		}	
	?>
	<!-- Modal -->
            <div class="modal fade" id="newWB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">新建工作台</h4>
                                </div>
                                <form role="form" action="action/newwb.php" method="post">
                                <div class="modal-body">
                                        <div class="form-group">
                                                <input class="form-control" placeholder="工作台名称" name="wbname" type="text" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                        <button type="submit" class="btn btn-primary">确认</button>
                                </div>
                                </form>
                        </div>
                        <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

		<br>	
		<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tasks fa-fw"></i> 工作台管理
				<button  class="btn btn-default btn-xs pull-right " data-toggle="modal" data-target="#newWB">
                                     <i class="fa fa-plus"></i>
				     <strong> 新建工作台</strong>
                            	</button>

			</div>
			<div class="panel-body draw" style="overflow-y: scroll;">
				<?php
                                if($_GET['alert']==-1) {
                        	?>
                                <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        共享成功！
                                </div>
                        	<?php
                                	}
                        	?>

				<?php
                                if($_GET['alert']==1) {
                        	?>
                                <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        不存在该用户！
                                </div>
                        	<?php
                                	}
                        	?>

				<?php
                                if($_GET['alert']==2) {
                        	?>
                                <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        该用户已拥有此工作台！
                                </div>
                        	<?php
                                	}
                        	?>
				<?php
				if($_GET['alert']==-2) {
				?>
				<div class="alert alert-danger alert-dismissable">
                                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        该工作台已存在！
                                </div>
				<?php
					}
				?>
				<div class="table-responsive">
                                	<table class="table table-striped">	
					<thead>
                                       		<tr>
                                            		<th>#</th>
                                            		<th>工作台</th>
                                       			<th>创建用户</th>
                                            		<th>创建时间</th>
                                            		<th>权限</th>
                                            		<th>共享/删除</th>
                                        	</tr>
                                    	</thead>
                                	<tbody>
				<?php
					$ids=$db->select("Limits","username='".$_SESSION['ml_username']."'");
					$count=0;
                                        if ($ids->num_rows > 0) {
                                                while($row = $ids->fetch_assoc()) {
                                                        $result1=$db->select("Workbench","id=".$row["wbid"]);
                                                        $wb = $result1->fetch_assoc();
							$count=$count+1;
				?>
                                        <tr>
						<td><?php echo $count ?></td>
						<td><a href="<?php echo "action/changewb.php?wbid=".$wb["id"] ?>"><?php echo $wb["wbname"] ?></a></td>
						<td>@ <?php echo $wb["username"] ?></td>
						<td><?php echo $wb["reg_date"] ?></td>
						<td><?php if ($row["lvl"]==3) {echo "查看";}else if($row["lvl"]==2){echo "完全共享";}else{echo "管理员";}  ?></td>
						<td>
							<?php if($row["lvl"]==3){ ?>
							<button  class="btn btn-info btn-xs disabled" >
								<i class="fa fa-link"></i>
							</button>
							<?php }else {?>
							<button  class="btn btn-info btn-xs " data-toggle="modal" data-target="#shareWB<?php echo $wb["id"]?>">
								<i class="fa fa-link"></i>
							</button>
							<?php } ?>
							<button  class="btn btn-danger btn-xs " data-toggle="modal" data-target="#delWB<?php echo $wb["id"]?>">
								<i class="fa fa-trash-o"></i>
							</button>
						</td>
                                	</tr>
				<?php
						}
					}
				?>
                        		</table>
				</div>
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
	
	
</body>

</html>
