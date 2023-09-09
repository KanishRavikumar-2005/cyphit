<?php 
session_start();
require_once("jsdb/jsdb-conn.php");
$jsdb = new Jsdb();
$LINusername = "";
$LINemail = "";
$LINuserid = "";
$LINuserfulln = "";
if(isset($_SESSION['username']) and isset($_SESSION['email']) and isset($_SESSION['userid'])){
  $LINusername = $_SESSION['username'];
  $LINemail = $_SESSION['email'];
  $LINuserid = $_SESSION['userid'];
$thisUser = $jsdb->get_row('jsdb/databases/users', "{`userId`:`$LINuserid`}");
  $LINuserfulln = $thisUser[0]['fullname'];
}else{
  echo "<script>window.location.assign('https://cyphit.redica.repl.co/login')</script>";
}

?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyphIt <?php if($LINusername !=""){echo " • ".$LINusername;} // • ?></title>
    <link rel='stylesheet' href='https://cyphit.redica.repl.co/designs/style.css'>
    <link rel='icon' href='https://cyphit.redica.repl.co/designs/logo.png'>
  </head>
  <body>
  <p class='hone'>Hello There<br> <?php echo $LINuserfulln;?></p>
    
    <p>Your User Id : <?php echo $LINuserid;?></p>
    <div class='mmx'>
    <a class='almx bbc' href='https://cyphit.redica.repl.co/take'>Take Photo</a>
    <a class='almx bbc' href='https://cyphit.redica.repl.co/verify'>Verify Photo</a>
      <a class='almx bbc' href='https://cyphit.redica.repl.co/find'>Find User</a>
      <a class='almx bbc' href='https://cyphit.redica.repl.co/nouser'>Service Page</a>
    </div>
  <div class='all'>
    <center>
    <?php 
$myImgs = $jsdb->get_row('jsdb/databases/encfiles', "{`userId`:`$LINuserid`}");
if(count($myImgs) > 0){
  echo "<p>My Photos</p>";
  foreach(array_reverse($myImgs) as $img){
    $imgloc = "EncFiles/".$img['imgId'].".enc";
    $fcode = file_get_contents($imgloc);
    echo "<div class='allim'><center><img src='$fcode'></center><br>
<button class='master' onclick='showDocument(\"$fcode\")'>View</button>
</div>";
  }
}else{
  echo "<p>You don't have any photos uploaded.</p>";
}
?>
</center>
  </div>
  </body>
</html>
<script>
  function showDocument(base64Url){
     var win = window.open('/', 'example','width=300,height=300');
     win.document.write("<title>Image Viewer • CyphIt</title><style>body{background-color: black;}</style><iframe style='width:100%;height: 100vh;border:none;background-color: black; text-align:center' src='" + base64Url +"'></iframe>");
}
</script>
<style>
  @media screen and (max-width: 350px){
    .frm-ct{
      padding: 0px;
    }
    .bbc{
      width: 100%;
    }
    .allim{
      width: 98%;
    }
    .allim img{
      width: 98%;
    }
  }
</style>