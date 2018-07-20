<?php

// php update data in mysql database using PDO

if(isset($_POST['edit']))
{
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=id5705848_todo","id5705848_assign4","assign4");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }

    // get values form input text and number

    $id = $_POST['id'];
    $created_on = $_POST['created_on'];
    $done_on = $_POST['done_on'];
    $name = $_POST['name'];

    // mysql query to Update data


    $query = "UPDATE `items` SET `name`=:name,`created_on`=:created_on,`done_on`=:done_on WHERE `id` = :id";
    $pdoResult = $pdoConnect->prepare($query);

    $pdoExec = $pdoResult->execute(array(":name"=>$name,":created_on"=>$created_on,":done_on"=>$done_on,":id"=>$id));

    if($pdoExec)
    {
        header('location:indexExample.php');
    }else{
        echo 'ERROR Data Not Updated';
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>edit data</title>
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
        <h1 class="header1" style="text-align:center">Rectify</h1>
        <form action="edit.php" method="post">
          <input type="hidden" name="id" placeholder="id" class="input" autocomplete="off" required value="<?php echo $_GET['id']; ?>">

          <input type="text" name="name" placeholder="Type the updated item here" class="input" autocomplete="off" required>
          <br>
          <input type="text" name="created_on" placeholder="dd/mm/yyyy-Creation date" class="input" autocomplete="off" required>
          <br>
          <input type="text" name="done_on" placeholder="dd/mm/yyyy-Expected date of completion" class="input" autocomplete="off" required>
          <br>
          <input type="submit" value="Edit"  class="submit" name="edit">
        </form>
      </div>
    </body>
</html>
