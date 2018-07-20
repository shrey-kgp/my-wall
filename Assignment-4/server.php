<?php

//session_start();
if(!isset($_SESSION))
    {
        session_start();
    }
// initializing variables
$username = "";
$email    = "";
$errors = array();


try {
// connect to the database
//$db = mysqli_connect('localhost', 'root', '', 'registration');  //registration is the database i created in my server
$db= new PDO("mysql:host=localhost;dbname=id5705848_todo",'id5705848_assign4','assign4');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  /*$username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password2']);
*/
//$db->beginTransaction();
//$db->exec("INSERT INTO users (username, lastname, email)
  //  VALUES ('John', 'Doe', 'john@example.com')");


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  //username validation
  if (empty(trim($_POST["username"]))) { array_push($errors, "Username is required"); }
  else{
    //prepare a select statement
    $usr="SELECT id FROM users WHERE username=:username";

    if ($stmt=$db->prepare($usr)){
      //bind variables to the prepared statements as parameters
      $stmt->bindParam(':username',$param_username,PDO::PARAM_STR);
      //set parameters
      $param_username=trim($_POST['username']);
      //execute the prepared statement
      if($stmt->execute()){
        if($stmt->rowCount()==1){
          array_push($errors, "Username already exists");
        }else{
          $username=trim($_POST['username']);
        }
      }else{
        echo 'something went wrong';
      }
    }
     //close the statements
     unset($stmt);
  }

//validation of the email
  if (empty(trim($_POST["email"]))) { array_push($errors, "Email is required"); }
  else{
    //prepare a select statement
    $eml="SELECT id FROM users WHERE email=:email";

    if ($stmt=$db->prepare($eml)){
      //bind variables to the prepared statements as parameters
      $stmt->bindParam(':email',$param_email,PDO::PARAM_STR);
      //set parameters
      $param_email=trim($_POST['email']);
      //execute the prepared statement
      if($stmt->execute()){
        if($stmt->rowCount()==1){
          array_push($errors, "email already exists");
        }else{
          $email=trim($_POST['email']);
        }
      }else{
        echo 'something went wrong';
      }
    }
     //close the statements
     unset($stmt);
  }


//validate password
//$password_1='password_1';
//$password_2='password_2';

  if (empty(trim($_POST['password_1']))) { array_push($errors, "Password is required"); }
  elseif (strlen(trim($_POST['password_1']))<5) {
    array_push($errors,"Password must have at least 5 characters");
  }else{
    $password_1=trim($_POST['password_1']);
  }

  if (empty(trim($_POST['password_2']))){
    array_push($errors,'Please confirm password');
  }else {
    $password_2=trim($_POST['password_2']);
    if ($password_1 != $password_2) {
  	array_push($errors, "The two passwords do not match");
    }
  }




  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  //$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  //$result = mysqli_query($db, $user_check_query);
  //$user = mysqli_fetch_assoc($result);
  /*$result = $db->query($user_check_query);
  $user=$result->fetch(PDO::FETCH_ASSOC);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }*/

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password_1')";
   if($stmt=$db->prepare($query)){
     //bind variables to the prepared statements as parameters
     $stmt->bindParam($username,$param_username,PDO::PARAM_STR);
     $stmt->bindParam($password_1,$param_password,PDO::PARAM_STR);

     //set parameters
     $param_username=$username;
     $password = md5($password_1);//encrypt the password before saving in the database
     $param_password=$password;

     //execute
     if($stmt->execute()){
       $_SESSION['username'] = $param_username;
       $_SESSION['success'] = "You are now logged in";
       header("location: indexExample.php");
     }else{
       echo'something went wrong';
     }
   }
//close statements
unset($stmt);
 }
unset($db);
}
}

catch(PDOException $e)
{
   echo $e->getMessage();
}


try{
// LOGIN USER
if (isset($_POST['login'])) {
//  $username = mysqli_real_escape_string($db, $_POST['username']);
//  $password = mysqli_real_escape_string($db, $_POST['password']);
$password="";





//$username=$db->quote($_POST['username']);
//$password=$db->quote($_POST['password']);


  if (empty(trim($_POST["username"]))) {
  	array_push($errors, "Username is required");
  }else{
    $username=trim($_POST["username"]);
  }
  if (empty(trim($_POST['password']))) {
  	array_push($errors, "Password is required");
  }else{
    $password=trim($_POST['password']);
  }

  if (count($errors) == 0) {
  //	$password = password_hash($password);
    // Prepare a select statement
    $sql = "SELECT username, password FROM users WHERE username = :username";
  //	$query = $db->prepare("SELECT * FROM users WHERE username='$username' AND password='$password'");
  	//$results = $db->query('$query');
//    $query->execute(array($username));
    if ($stmt= $db->prepare($sql)){
      //bind variables to the prepared statement as parameters
      $stmt->bindParam(':username',$param_username,PDO::PARAM_STR);
      //set parameters
      $param_username=trim($_POST["username"]);
      //attempt to execute the prepared statements
      if($stmt->execute()){
        //check if username exists, if yes then verify
           if($stmt->rowCount()==1){
             if($row=$stmt->fetch()){
               //$hashed_password=$row['password'];
               if($password==$row['password']){
                 $_SESSION['username'] = $username;
                 $_SESSION['success'] = "You are now logged in";
                 header('location: indexExample.php');

               }else {
             array_push($errors, "Wrong username,password combination");
           }
           }
         }else{
           array_push($errors, "Wrong username/password combination");
         }
       }
      }


    }

    //$results=$query->rowCount();
  	//if ($results == 1) {
    unset($stmt);
  }
  unset($db);
}

catch(PDOException $e)
{
   echo $e->getMessage();
}

?>
