<?php include 'includes/session.php';
 include 'includes/slugify.php';
if (isset($_POST['add'])) {
$user_id=$_POST['user_id'];
$writers_name=$_POST['writers_name'];
$name = $_POST['name'];
$slug =slugify($name);
$category =$_POST['category'];
$description = $_POST['description'];
$filename =$_FILES['photo']['name'];
$date_posted=$_POST['date_posted'];
$image_description=$_POST['image_description'];
$conn = $pdo->open();
$smtp =$conn->prepare("SELECT *,COUNT(*) As numrows FROM published WHERE slug =:slug  " );
$smtp->execute(['slug'=>$slug]);
$row=$smtp->fetch();
if ($row['numrows']> 0) {
	$_SESSION['error']="Update Already Exists";
}
else{
if (!empty($filename)) {
	$ext=pathinfo($filename, PATHINFO_EXTENSION);
	$new_file_Name = $slug.'.'.$ext;
	move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_file_Name);
		}
	else{
		$new_file_Name ='';
	}
	try {
		$smtp = $conn->prepare("INSERT INTO published(category_id,name, description,user_id, slug,writers_name, photo,date_posted,image_description) values (:category, :name, :description,:user_id, :slug,:writers_name, :photo,:date_posted,:image_description)");
		$smtp->execute(['category'=>$category,'name'=>$name,'description'=>$description,'user_id'=>$user_id,'slug'=>$slug,'writers_name'=>$writers_name,'photo'=>	$new_file_Name,'date_posted'=>$date_posted,'image_description'=>$image_description]);
		$_SESSION['success'] = 'Update added successfully';
	} catch (PDOException $e) {
		$_SESSION['error']=$e->getMessage();
	}



}
$pdo->close();

}
else{
	$_SESSION['error']="Fill up the form first";
}
header('location: updates.php');
 ?>
