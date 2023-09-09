<?php 
require_once("../jsdb/jsdb-conn.php");
$jsdb = new Jsdb();
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify • CyphIt</title>
    <link rel='stylesheet' href='https://cyphit.redica.repl.co/designs/style.css'>
    <link rel='icon' href='https://cyphit.redica.repl.co/designs/logo.png'>
  </head>
  <body>
    <center>
      <p class='hone'>Find Who Owns A Pic</p>
      <a class='almx bbc' href='https://cyphit.redica.repl.co/'>Go Home</a><br><br>
      <input type='file' id='flc' onchange='decd(this)'><br>
  <img src='' id='vvv' style='width: 320px;height: 240px;display:none;'><br>
  <button onclick='dkode()' id='ppxl' style='display:none;' class='paster'>Select Image</button>
      <div id='whon' style='display:none;'>
        <form method="post">
        <button name='seon' class='paster' style='background-color:green;'>See Who Owns This</button>
        <input type='hidden' id='eid' name='encid'>
        </form>
      </div>
    </center>
      <script src='https://cyphit.redica.repl.co/designs/stegano.js'></script>
  </body>
  <?php 
if(isset($_POST['seon'])){
  $cod = $_POST['encid'];
  $userOn = $jsdb->get_row('../jsdb/databases/encfiles',"{`EncStr`:`$cod`}");
  if(count($userOn) < 1){
    echo "<center><p style='color:red;'>This Image Is Not From CyphIt</p></center>";
  }else{
  $userOfThis = $userOn[0]['userId'];
  $theUser = $jsdb->get_row('../jsdb/databases/users',"{`userId`:`$userOfThis`}");
  $UserName = $theUser[0]['username'];
  $UserMid = $theUser[0]['userId'];
  $UserMail = $theUser[0]['email'];
  echo "<Center>
This Image Is Owned By <b>$UserName</b><br>
View Users Page <a href='https://cyphit.redica.repl.co/user?id=$UserMid'>Here</a><br>
$UserName Email Id : <a href='mailto:$UserMail' style='color: #202020'>$UserMail</a>
</Center>";
  }
}
?>
</html>
<script>
  function decd(input) {
  var reader = new FileReader();
  reader.onload = function(e) {
    nig = e.target.result
    document.getElementById('vvv').src = nig
    document.getElementById('vvv').style.display="block"
    document.getElementById('ppxl').style.display="block"
    
  }
  reader.readAsDataURL(input.files[0])
}
function dkode() {
  console.log(nig);
  document.getElementById('ppxl').style.display="none"
  document.getElementById('whon').style.display = "block";
  document.getElementById('eid').value = steg.decode(nig);
  
  
}
</script>