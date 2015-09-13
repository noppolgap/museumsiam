<?php
require("../../assets/configs/config.inc.php");
require("../../assets/configs/connectdb.inc.php");
require("../../assets/configs/function.inc.php");

if(isset($_GET['enable'])){

  $id = $_GET['web_id'];
  $flag = $_GET['flag'];
  $Flag = "";

  if($flag == 1){
  	 $Flag = 0;
  }
  else{
  	 $Flag = 1;
  }
  $update="";
  $update[]= "Flag = $Flag";

  $sql="UPDATE trn_webboard SET  ".implode(",",$update)." WHERE WEBBOARD_ID =".$id;
  
  mysql_query($sql,$conn);
	
  header('Location: index.php');
	
}

if(isset($_GET['delete'])){

  $id = $_POST['id'];
  $update="";
  $update[]= "FLAG = 2";

  $sql="UPDATE trn_webboard SET  ".implode(",",$update)." WHERE WEBBOARD_ID =".$id;
  
  mysql_query($sql,$conn);
	
  //header('Location: index.php');
	
}

if(isset($_GET['search'])){

	 $sql="";
     mysql_query($sql,$conn);
}

?>