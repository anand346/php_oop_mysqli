<?php
include "config.php";
include "database.php";
$db = new Database();
if(isset($_GET['id'])){
$id = $_GET['id'];
 $query = "DELETE FROM tbl_user WHERE id=$id";
 $deleteData = $db->delete($query);
 if($deleteData){
     header("location:index.php");
 }
}else{
    echo "please provide client's id ";die();
}
?>