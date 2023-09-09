<?php 
session_start();
require_once("../jsdb/jsdb-conn.php");
$jsdb = new Jsdb();
$nuid = "";
$oj_usn = "";
$oj_fln = "";
$oj_eml = "";
$oj_uid = "";
if(isset($_GET['id'])){
  $nuid = $_GET['id'];
  if(isset($_SESSION['userid'])){
    if($_SESSION['userid'] == $nuid){
      echo "<script>window.location.assign('https://cyphit.redica.repl.co')</script>";
    }
  }
  $mep = $jsdb->get_row("../jsdb/databases/users", "{`userId`:`$nuid`}");
  if(count($mep) < 1){
    echo "<script>
alert('User Does Not Exist')
window.location.assign('https://cyphit.redica.repl.co')
</script>";
  }
  $ojuser = $mep[0];
  $oj_usn = $ojuser['username'];
  $oj_fln = $ojuser['fullname'];
  $oj_eml = $ojuser['email'];
  $oj_uid = $ojuser['userId'];
  $psts = $jsdb->get_row("../jsdb/databases/encfiles", "{`userId`:`$nuid`}");
}else{
  echo "<script>window.location.assign('https://cyphit.redica.repl.co')</script>";
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyphIt • <?php echo $oj_usn; // • ?></title>
    <link rel='stylesheet' href='https://cyphit.redica.repl.co/designs/style.css'>
    <link rel='icon' href='https://cyphit.redica.repl.co/designs/logo.png'>
  </head>
  <body>
    <center>
      <h1><?php echo $oj_fln; // • ?></h1>
      <p>@<?php echo $oj_usn; // • ?></p>
      <p><a style='color: black;' href='mailto:<?php echo $oj_eml; // • ?>'><?php echo $oj_eml; // • ?></a></p>
      <div class='mmx'>
    <a class='almx bbc' href='https://cyphit.redica.repl.co/'>Go Home</a>
    <a class='almx bbc' href='https://cyphit.redica.repl.co/verify'>Verify Photo</a>
        <a class='almx bbc' href='https://cyphit.redica.repl.co/nouser'>Service Page</a>
    </div>
      <hr>
      <div class='all'>
        <center>
    <?php 

if(count($psts) > 0){
  echo "<p>My Photos</p>";
  foreach(array_reverse($psts) as $img){
    $imgloc = "../EncFiles/".$img['imgId'].".enc";
    $fcode = file_get_contents($imgloc);
    echo "<div class='allim'><center><img src='$fcode'></center><br>
<button class='master' onclick='showDocument(\"$fcode\")'>View</button>
</div>";
  }
}else{
  echo "<p>User doesn't have any photos uploaded.</p>";
}
?>
      </div>
    </center>
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
  }
</style>