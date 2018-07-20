<?php
require_once'initExample.php';

if(isset($_POST['name']) && isset($_POST['created_on']) && isset($_POST['done_on'])){
  $name=trim($_POST['name']);
  $created_on=trim($_POST['created_on']);
  $done_on=trim($_POST['done_on']);

 $addedQuery=$db->prepare('
  INSERT INTO items (name,user,created_on,done_on,done)
  VALUES (:name,:user,:created_on,:done_on,0)
 ');
    $addedQuery->execute([
          'user'       => $_SESSION['username'],
          'name'       => $name,
          'created_on' => $created_on,
          'done_on'    => $done_on

    ]);
}



header ('location:indexExample.php');

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	//mysqli_query($db, "DELETE FROM items WHERE id=$id");
 $deletedQuery=$db->prepare("
  DELETE FROM items WHERE id=$id
 ");
 $deletedQuery->execute();

  $_SESSION['message'] = "Deleted!";
	header('location: indexExample.php');
}

if(isset($_POST['post_image'])){
  $file=$_FILES['post_image'];
  $fileName=$_FILES['post_image']['name'];
  $fileTmpName=$_FILES['post_image']['tmp_name'];
  $fileSize=$_FILES['post_image']['size'];
  $fileError=$_FILES['post_image']['error'];
  $fileType=$_FILES['post_image']['type'];

  $fileExt=explode('.', $fileName);
  $fileActualExt=strtolower(end($fileExt));

  $allowed=array('jpg','jpeg','png','pdf');
  if(in_array($fileActualExt,$allowed)){
     if($fileError===0){
         if($fileSize < 1000000){

              $fileNameNew= uniqid('',true).".".$fileActualExt;
              $fileDestination = 'uploads/'.$fileNameNew;
              move_uploaded_file($fileTmpName,$fileDestination);
              $finalDestination=$fileDestination;
            $anotherAddedQuery=$db->prepare('
               INSERT into items (post_image)
               VALUES (:post_image)
            ');
            $anotherAddedQuery->bindParam(':post_image',$finalDestination);
            $anotherAddedQuery->execute();
            if($anotherAddedQuery->execute()){
              header("Location: indexExample.php?uploadsuccess");
            }else{
              header("Location: indexExample.php?uploadnotsuccessful");
            }

         }else{
           echo "Your file is too big";
         }

     }else{
       echo "There was an error uploading your file";
     }

  }else{
    echo "You cannot upload files of this type";
  }

}




 ?>
