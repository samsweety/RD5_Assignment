<?php
    session_start();
    if(isset($_GET["logout"])){
        session_unset();
        header("location:index.php");
        exit();
    }
    if(isset($_POST["home"])){
      header("location:index.php");
      exit();
    }
    if(isset($_POST["signup"])){
      header("location:signup.php");
      exit();
    }



?>

<?php
  $link=mysqli_connect("localhost","root","root","bank");
  mysqli_query($link,"set names utf-8"); 
   if(isset($_POST["login"])){
    if(empty($_POST["txtUserName"])||empty($_POST["txtPassWord"])){
      echo "帳號密碼不能為空值";
    }else{
      $userName=$_POST["txtUserName"];
      $sql=<<<sql
          select aid,pw from account where userName="$userName";
        sql;
      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_assoc($result);
      if($row["pw"]!=$_POST["txtPassWord"]){
        echo "帳號密碼錯誤";
      }
      else {
        $_SESSION["userName"]=$userName;
        $_SESSION["aid"]=$row["aid"];
        header("location:index.php");
        exit();

      }
    }

   }
    
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>隨便啦金融-登入</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  

</head>
<body>
<nav class="navbar navbar-expand-sm bg-primary navbar-primary">
  <!-- Brand/logo -->
  <a class="navbar-brand text-danger" href="index.php">隨便</a>
  
  <!-- Links -->
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <?php if(!isset($_SESSION["userName"])){?>
        <a class="nav-link" style="color:yellow" href="login.php">登入</a>
      <?php }else{?>
        <a class="nav-link" style="color:red" href="login.php?logout=1">登出</a>
      <?php }?>
    </li>
    <span class="navbar-text">
        當前使用者： <?= (isset($_SESSION["userName"])?$_SESSION["userName"]:"訪客" )?>
    </span>
  </ul>
</nav>

<div class="container">           
  <table class="table table-danger">
    <thead>
      <tr align="center">
        <th>帳號</th>
        <th>
        <th>密碼</th>
      </tr>
      <form method="post">
      <tr align="center">
        <th><input type="text" name="txtUserName" id="txtUserName"></th>
        <th>
        <th><input type="password" name="txtPassWord" id="txtPassWord"></th>
      </tr>
      <tr align="center">
        <th><input type="submit" class="btn-outline-success" name="login" id="login" value="登入"></th>
        <th><input type="submit" class="btn-outline-danger"  name="home" id="home" value="回首頁"></th>
        <th><input type="submit" class="btn-outline-primary" name="signup" id="signup" value="註冊"></th>
      </tr>
      </form>
    </thead>    
  </table>
</div>
       
</body>
</html>
