<?php 
include 'inc/header.php'; 
include "config.php";
include "Database.php";
?>

<?php
 if(isset($_GET['id'])){
    $id = $_GET['id'];
    $db = new Database();
    $query = "SELECT * FROM tbl_user WHERE id=$id";
    $getData = $db->select($query);
    if($getData){
        $getData = $getData->fetch_assoc();
    }else{
        die("no data available for this id");
    }
 }else{
     echo "please provide client's id";die();
 }
 
 
if(isset($_POST['submit'])){
 $name  = mysqli_real_escape_string($db->link, $_POST['name']);
 $email = mysqli_real_escape_string($db->link, $_POST['email']);
 $skill = mysqli_real_escape_string($db->link, $_POST['skill']);
 if($name == '' || $email == '' || $skill == ''){
  $error = "Field must not be Empty !!";
 } else {
  $query = "UPDATE tbl_user
  SET
  name  = '$name',
  email = '$email',
  skill = '$skill'
  WHERE id = $id";

  $update = $db->update($query);
  if($update){
      header("location:index.php");
  }
 }
}
?>


<?php 
if(isset($error)){
 echo "<span style='color:red'>".$error."</span>";
}
?>
<form action="update.php?id=<?php echo $id;?>" method="post">
<table>
 <tr>
  <td>Name</td>
  <td><input type="text" name="name" 
  value="<?php echo $getData['name'] ?>"/></td>
 </tr>
 <tr>
  <td>Email</td>
  <td><input type="text" name="email"
  value="<?php echo $getData['email'] ?>"/></td>
 </tr>

 <tr>
  <td>Skill</td>
  <td><input type="text" name="skill" 
  value="<?php echo $getData['skill'] ?>"/></td>
 </tr>
 <tr>
  <td></td>
  <td>
  <input type="submit" name="submit" value="Update"/>
  <input type="reset" Value="Cancel" />
  <button><a href="delete.php?id=<?php echo $id;?>" style = "text-decoration:none;color:black;">delete</a></button>
  </td>
 </tr>

</table>
</form>
<a href="index.php">Go Back</a>
<?php include 'inc/footer.php'; ?>