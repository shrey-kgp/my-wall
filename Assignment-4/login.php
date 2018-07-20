<?php include('server.php') ?>

<!DOCTYPE html>
<html>

<head>
<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

<style type="text/css">

* {
    box-sizing: border-box;
}
.header { overflow: hidden;
           box-sizing: border-box;

		   }
.header a {float: left;
              display: block;
              background-color:white;
              color: black;
              text-align: center;
              padding: 20px 65px;
              text-decoration: none;
			  box-sizing: border-box;
        border-radius: 8px;
}

.header a:hover{text-decoration: none;
                   background-color: green;
				   box-sizing: border-box;
				   }


.row::after {
    content: "";
    clear: both;
    display: table;
}
[class*="col-"] {
    float: left;
    padding: 15px;

}

.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;
         }
img {
    box-sizing: border-box;
	border:1px dashed white;}
body{font-family: 'Indie Flower', cursive;
     color:white;

		  background-color:black;
		  }
input[type=text],input[type=password]  {width:100%;
                  padding:26px 20px;
				  box-sizing:border-box;
          border-radius: 8px;
				  border:2px solid red;}
input[type=submit] {background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
  }

</style>



</head>
<body>

<div class="header">
  <h2 style="font-size:2vw"><a href="index.php">Sign Up</a></h2>
</div>

<div class="row">
<div class="col-6">
<form style="font-size:3vw" method="post" action="login.php">
  <?php include('error.php'); ?>
  <label for="username">Username:</label>
  <input type="text" name="username" maxlength="15" />
<br />
<br />
  <label for="password">Password:</label>
  <input type="password" name="password" maxlength="10" minlength="5" />
<br/>
<br/>
  <input type="submit" value="Login" name="login">

</form>
</div>

<div class="col-6">
  <p style="font-size:3vw"><strong><i>Ahoy People!<br/>Login here.</i></strong></p>
  <img src="BG6.jpg" style="width:100%">
</div>
</div>

</body>
</html>
