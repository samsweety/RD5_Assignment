<?php
    session_start();
     if(!isset($_SESSION["userName"])){
        header("location:login.php");
        exit();
     }
    if(isset($_POST["hide"])){
        if(isset($_SESSION["hide"])){
            unset($_SESSION["hide"]);
        }else{
            $_SESSION["hide"]=1;
        }
    }
    
 
?>

<?php
    $link=mysqli_connect("localhost","root","root","bank");
    mysqli_query($link,"set names utf-8");
    $aid=$_SESSION["aid"];
    $money="";
    $sql=<<<sql
          select cash from account where aid="$aid";
      sql;
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
    $money=$row["cash"];
    if(isset($_POST["btnOK"])){
      $amount=$_POST["amount"];
      if(!is_numeric($_POST["amount"])){
        echo "輸入的值並非數字";
      }else if($_POST["amount"]<1){
        echo "輸入的值小於一";
      }else if($amount>$money){
        echo "餘額不足";
      }else{
      $sql=<<<sql
          update account set cash=cash-$amount where aid=$aid;
        sql;
      mysqli_query($link,$sql);
      $sql=<<<sql
          insert into accDetail (aid,operate,amount) values ($aid,2,$amount);
        sql;
      mysqli_query($link,$sql);
      }
    }



    if(!isset($_SESSION["userName"])){
      header("location:login.php");
      exit();
    }else{
      $sql=<<<sql
              select cash from account where aid="$aid";
          sql;
      $result=mysqli_query($link,$sql);
      $row=mysqli_fetch_assoc($result);
      $money=$row["cash"];
 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>隨便啦金融</title>
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
        <a class="nav-link" style="color:yellow" href="login.php?logout=1">登出</a>
      <?php }?>
    </li>
    <span class="navbar-text">
        當前使用者： <?= (isset($_SESSION["userName"])?$_SESSION["userName"]:"訪客" )?>
    </span>        
  </ul>
</nav>

<div class="container">      
  <table class="table table-danger table-hover">
    <thead>
      <tr>
        <th>帳戶餘額：</th>
        <th><?= (isset($_SESSION["hide"]))?"******":$money?></th>
        <form method="post">                
        <th style="text-align:center">
        <input type="submit" name="hide" class="btn-warning" value="<?= (isset($_SESSION["hide"]))?"顯示餘額":"隱藏餘額"?>">
        </th>
        </form>
      </tr>
    </thead>    
    <tbody>
        <tr>
            <td>提款金額</td>
            <td></td>
            <td></td>
        </tr>
        <tr><form method="post">
            <td><input type="text" name="amount" ></td>
            <td><input type="submit" name="btnOK" class="btn-success" value="確認"></td>
            <td></td>
            </form>
        </tr>
    </tbody>
    
  </table>
        
</body>
</html>