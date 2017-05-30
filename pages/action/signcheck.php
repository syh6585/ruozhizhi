<?php  
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
	ini_set("display_errors", "On"); 
        error_reporting(E_ALL | E_STRICT); 
        $user = $_POST["username"];  
        $psw = md5($_POST["password"]);  
	$psw2 = md5($_POST["confirm"]);  
        if($psw != $psw2)  
        {  
		$url = "../login.php?alert=-1";  
		header( "Location: ".$url ); 
        }  
       else  
        {  
		require_once '/data/website/libble/pages/class/mysql.class.php';
        	$db=new Mysql();
        	$result = $db->select("Users","username='".$user."'");

		if ($result->num_rows == 0) {
			$flag=$db->insert("Users","(username,password)","('".$user."','".$psw."')");
			if ($flag) {
				$url = "../login.php?alert=2";  
				header( "Location: ".$url ); 
			}
		} else {	
			$url = "../login.php?alert=-2";  
			header( "Location: ".$url ); 
		}	 
	} 
    }  
?>  
