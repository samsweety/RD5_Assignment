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
    $sqldetail=<<<sql
            select * from accDetail where aid=$aid order by ts desc;
        sql;
    $resultDetail=mysqli_query($link,$sqldetail);
  $money="";
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
        <th style="text-align:right"></th>
      </tr>
    </thead>    
    <tbody>
        <tr>
            <td>操作</td>
            <td>金額</td>
            <td>時間</td>
        </tr>
        <?php for(;$row=mysqli_fetch_assoc($resultDetail);){?>
        <tr>
            <?php if($row["operate"]==1){?>
                <td style="color:red"><?= "存款"?></td>
            <?php }else{?>
                <td style="color:green"><?= "提款"?></td>
            <?php }?>
            <td><?= $row["amount"]?></td>
            <td><?= $row["ts"]?></td>
        </tr>      
        <?php }?>
    </tbody>
    
  </table>
        
</body>
</html>