<?php
	unset($_SESSION["ml_username"]);
	unset($_SESSION["ml_wbid"]);
	unset($_SESSION["ml_taskid"]);
	header("Location:../login.php");

?>
