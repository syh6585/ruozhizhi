<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LIBBLE - 登录</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<?php
		if(isset($_SESSION['ml_username'])) {
			header("Location:index.php");
		}
	?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>LIBBLE</strong></h3>
                    </div>
                    <div class="panel-body">
			<ul class="nav nav-tabs">
			<?php if ($_GET["alert"]<0){?>
                                <li><a href="#tab1" data-toggle="tab">登录</a>
                                </li>
                                <li class="active"><a href="#tab2" data-toggle="tab">注册</a>
                                </li>
			<?php }else{ ?>
                                <li class="active"><a href="#tab1" data-toggle="tab">登录</a>
                                </li>
                                <li><a href="#tab2" data-toggle="tab">注册</a>
                                </li>
			<?php } ?>
                        </ul>
			<!-- Tab panes -->
                        <div class="tab-content">
				<br>
				<?php if ($_GET["alert"]<0){?>
                                <div class="tab-pane fade" id="tab1">
				<?php }else{ ?>
                                <div class="tab-pane fade in active" id="tab1">
				<?php } ?>
                        		<form role="form" action="action/logincheck.php" method="post">
                            		<fieldset>
                                		<div class="form-group">
                                    			<input class="form-control" placeholder="用户名" name="username" type="username" autofocus required>
                                		</div>
                                		<div class="form-group">
                                    			<input class="form-control" placeholder="密码" name="password" type="password" value="" required>
                                		</div>
						<?php if ($_GET["alert"]==1){?>
						<div class="alert alert-danger alert-dismissable">
                                			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                			用户名或密码错误！ 
                            			</div>
						<?php } ?>
						<?php if ($_GET["alert"]==2){?>
						<div class="alert alert-info alert-dismissable">
                                			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                			注册成功！ 
                            			</div>
						<?php } ?>
                                		<button type="submit" class="btn btn-lg btn-success btn-block">登录</button>
                            		</fieldset>
                        		</form>
				</div>
				<?php if ($_GET["alert"]<0){?>
                                <div class="tab-pane fade in active" id="tab2">
				<?php }else{ ?>
                                <div class="tab-pane fade" id="tab2">
				<?php } ?>
                        		<form role="form" action="action/signcheck.php" method="post">
                                        <fieldset>
                                                <div class="form-group">
                                                        <input class="form-control" placeholder="用户名" name="username" type="username" autofocus required>
                                                </div>
                                                <div class="form-group">
                                                        <input class="form-control" placeholder="密码" name="password" type="password" value="" required>
                                                </div>
                                                <div class="form-group">
                                                        <input class="form-control" placeholder="确认密码" name="confirm" type="password" value="" required>
                                                </div>
						<?php if ($_GET["alert"]==-1){?>
						<div class="alert alert-danger alert-dismissable">
                                			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                			两次输入的密码不一致！ 
                            			</div>
						<?php } ?>
						<?php if ($_GET["alert"]==-2){?>
						<div class="alert alert-danger alert-dismissable">
                                			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                			用户已存在！ 
                            			</div>
						<?php } ?>
                                                <button type="submit" class="btn btn-lg btn-success btn-block">注册</button>
                                        </fieldset>
                                        </form>
                                </div>
                        <div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
