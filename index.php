<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ระบบแจ้งซ่อมสุขภัณฑ์-ครุภัณฑ์ออนไลน์</title>

  <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
  <script
  src="js/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
  <script src="semantic/dist/semantic.min.js"></script>


  <style type="text/css">
  .fullfooter{
    height: 20%;
  }

</style>

</head>
<body>

  <div class="ui inverted  fixed menu " id="non-printable">
    <div class="ui container">
     <div class="item">
     <?php
         @session_start();
      if(!isset($_SESSION['user'])&&!isset($_SESSION['admin']))
        echo " <h3 class=\"ui header inverted\">ระบบแจ้งซ่อมสุขภัณฑ์-ครุภัณฑ์ออนไลน์</h3>";

     ?>
    </div>
    <?php
    if(isset($_SESSION['admin']))
    {
      if(isset($_GET['userac'])){
        if($_GET['userac']=='lists')
          echo "<a class='item  active' href='index.php?index=main&userac=lists'>ข้อมูลการทำงาน</a> ";
        else{
          echo "<a class='item ' href='index.php?index=main&userac=lists'>ข้อมูลการทำงาน</a> ";
        }

        if($_GET['userac']=='state')
          echo "<a class='item left active' href='index.php?index=main&userac=state'>รายงาน</a> ";
        else
         echo "<a class='item left' href='index.php?index=main&userac=state'>รายงาน</a> ";


     }
     else{
      echo "<a class='item ' href='index.php?index=main&userac=lists'>ข้อมูลการทำงาน</a> ";
      echo "<a class='item left' href='index.php?index=main&userac=state'>รายงาน</a> ";
    }

    ?>
    <div class="item right ">
      <div class="ui floating dropdown icon">
        <i class="settings icon "></i>
        <div class="menu">
          <div class="item"><a href="index.php?index=main&userac=createmem" class="ui"><i class="edit icon"></i>จัดการผู้ใช้งาน</a></div>

        </div>
      </div>
    </div>
    <?php
               //echo "<div class='item right'><i class='key icon'></i></div>";
    echo "<a class='item' href='index.php?index=logout'>ออกจากระบบ</a> ";
  }
  else if(isset($_SESSION['user'])){
    if(isset($_GET['userac'])=='lists')
      echo "<a class='item left active' href='index.php?index=main&userac=lists'>รายการแจ้งซ่อมของฉัน</a> ";
    else
      echo "<a class='item left' href='index.php?index=main&userac=lists'>รายการแจ้งซ่อมของฉัน</a> ";
    echo "<a class='item right' href='index.php?index=logout'>ออกจากระบบ</a> ";
  }
  else{
    echo "<a class='item right' href='index.php?index=signin'>  <i class='key icon'></i> เข้าสู่ระบบ</a>";
  }
  ?>


</div>
</div>


<?php

if(isset($_GET['index'])){
  $index = $_GET['index'];
}else{
  $index = 'defualt';
}
switch($index){
  case 'signin':
  include_once('systems/checkAuth.php');
  include_once("pages/login.php"); 
  break;
  case 'defualt':
          //include_once('systems/checkauth.php');
  //include_once("pages/welcome.php"); 
  include_once('systems/checkAuth.php');
  include_once("pages/login.php"); 
  break;
  case 'action':
  include_once("pages/action.php"); 
  break;
  case 'main':
  include_once('systems/noneauth.php');
  include_once("pages/main.php"); 
  break;
  case 'lists':
  include_once('systems/checkauthUser.php');
  include_once("pages/list.php"); 
  break;
  case 'logout':
  include_once("pages/logout.php"); 
  break;
  default :
  include_once("pages/404.php"); 
  break;
}

?>

</body>
<script type="text/javascript">
  $(document).ready(function(){
    $('.ui.dropdown').dropdown();
  });
</script>
</html>