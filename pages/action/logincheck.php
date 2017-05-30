<?php  
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
	#ini_set("display_errors", "On"); 
	#error_reporting(E_ALL | E_STRICT); 
	$user = $_POST["username"];  
        $psw = md5($_POST["password"]);
	require_once '/data/website/libble/pages/class/mysql.class.php'; 
	$db=new Mysql();
	$result = $db->select("Users","username='".$user."' and password='".$psw."'");
        if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$_SESSION['ml_username'] = $row["username"];
		$url = "../index.php";
                header( "Location: ".$url );

	} 
	else {
		$url = "../login.php?alert=1";
                header( "Location: ".$url );
        } 
    } 
    else{
	$url = "../login.php";
        header( "Location: ".$url );
	
    } 
?>  
