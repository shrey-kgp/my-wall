<?php

require_once 'initExample.php';

$itemsQuery =$db->prepare("
     SELECT id,name,done,created_on,done_on,post_image
     FROM items
     WHERE user=:user

");
 $itemsQuery->execute([
'user'=>$_SESSION['username']

 ]);
$items=$itemsQuery->rowCount() ? $itemsQuery :[];
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

//foreach($items as $item){
//  echo $item['name'],'<br>';
//}
//update function
/*if (isset($_POST['edit'])) {
	$name = $_POST['name'];
	$created_on = $_POST['created_on'];
  $done_on = $_POST['created_on'];

	//mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
$updatedQuery=$db->prepare("
   UPDATE items SET name='$name', created_on='$created_on', done_on='$done_on' WHERE user=:user
");
$updatedQuery->execute(['name'=>$name,
'done_on'=>$done_on,
'created_on'=>$created_on,
'user'=> $_SESSION['user_id']
]);

  $_SESSION['message'] = "Updated!";
	header('location: indexExample.php');
}
*/


?>

<!DOCTYPE html>

<html lang="en">
      <head>
        <meta charset = "UTF-8">
      	<link rel="stylesheet" type="text/css" href="mystyle.css">
        <link rel="stylesheet" type="text/css" href="css.css">
        <link rel="stylesheet" type="text/css" href="css_1.css">        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
      </head>

<body>

<div class="list">
  <h1 class="header1" style="text-decoration:underline;text-align:center">ActApp<br>Realign your life!</h1>

  <?php if(!empty($items)): ?>
      <ul class="items">

          <?php foreach($items as $item): ?>
          <li>
            <span class="item<?php echo $item['done'] ? '-done' : '' ?>"><?php echo '<strong>Task:</strong>',' ',$item['name'],'<br>'; ?></span>
            <span class="item<?php echo $item['done'] ? '-done' : '' ?>"><?php echo '<strong>Created on:</strong>',' ',$item['created_on'],'<br>'; ?></span>
            <span class="item<?php echo $item['done'] ? '-done' : '' ?>"><?php echo '<strong>Expected date of completion:</strong>',' ',$item['done_on'],'<br>'; ?></span>
            <span class="item<?php echo $item['done'] ? '-done' : '' ?>" ><img src="uploads/<?php echo $item['post_image']; ?>" style="width:150px;height:150px;"></span>


            <?php if(!$item['done']) :  ?>

              <a href="mark.php?as=done&item=<?php echo $item['id'];?>" class="done-button">Mark as done</a>


              <a href="edit.php?id=<?php echo $item['id']; ?>&edit=<?php echo $item['id']; ?>" class="edit_btn" >Edit</a>


              <?php endif; ?>
              <a href="add_example.php?del=<?php echo $item['id']; ?>" class="del_btn">Delete</a>
          </li>
          <br>
        <?php endforeach; ?>
      </ul>
  <?php else:  ?>
  <p>You haven't added anything yet</p>
  <?php endif; ?>
<form action="add_example.php" method="post" class="item-add">
   <input type="text" name="name" placeholder="Type a new item here" class="input" autocomplete="off" required>
   <input type="text" name="created_on" placeholder="dd/mm/yyyy-Creation date" class="input" autocomplete="off" required>
   <input type="text" name="done_on" placeholder="dd/mm/yyyy-Expected date of completion" class="input" autocomplete="off" required>
   <input type="file" name="post_image" class="input">

   <input type="submit" value="Add"  class="submit" >
</form>
<?php  if (isset($_SESSION['username'])) : ?>
  <br>
  <p style="text-align:center">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
  <p style="text-align:center"> <a href="indexExample.php?logout='1'" style="color:red;text-decoration:none;">LOGOUT</a> </p>
<?php endif ?>
</body>
</html>
