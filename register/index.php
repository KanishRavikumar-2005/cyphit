<?php 
session_start();
require_once("../jsdb/jsdb-conn.php");
$jsdb = new Jsdb();
function idgen($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register • CyphIt</title>
    <link rel='stylesheet' href='https://cyphit.redica.repl.co/designs/style.css'>
    <link rel='icon' href='https://cyphit.redica.repl.co/designs/logo.png'>
  </head>
  <body>
    <br>
    <br>
     <center>
       <img src='https://cyphit.redica.repl.co/designs/logop.png' style='width:150px;height:150px;' draggable='false'>
       <h3>CyphIt Register</h3>
       <div class='frm-ct'>
         <form method='post'>
           <label>Username</label><br>
           <input type='text' name='ussn' id='uname' placeholder='Enter Username' oninput='Check(event)' required><br>
           <label>Fullname</label><br>
           <input type='text' name='fln' placeholder='Enter Fullname' required><br> 
           <label>Email</label><br>
           <input type='email' name='eml' placeholder='Enter Email' required><br>
           <label>Password</label><br>
           <input type='password' name='psw' placeholder='Enter Password' required><br>
           <label>Re-Enter Password</label><br>
           <input type='password' name='rpsw' placeholder='Re-Enter Password' required><br>
           <button name='reg'>Register</button>
           <br>
           <br>
           <label>Already have an account? <a href='https://cyphit.redica.repl.co/login' style='text-decoration:none;'>Login</a></label>
         </form>
         <a class='almx bbc' href='https://cyphit.redica.repl.co/nouser'>Service Page</a>
       </div>
       <?php 
if(isset($_POST['reg'])){
  $usn = $jsdb->safe($_POST['ussn']);
  $pass = $jsdb->safe(hash('sha256',$_POST['psw']));
  $rpass = $jsdb->safe(hash('sha256',$_POST['rpsw']));
  $fullname = $jsdb->safe($_POST['fln']);
  $mail = $jsdb->safe($_POST['eml']);
  $row = $jsdb->get_row('../jsdb/databases/users', "{`username`:`$usn`}");
  if(count($row) >= 1){
    echo "<p style='color:red;'>Username already taken.</p>";
  }
  else if(count($row) == 0){
    if($rpass == $pass){
      $randId = idgen(20);
      $jsdb->add_row("../jsdb/databases/users", "{`username`:`$usn`, `fullname`:`$fullname`, `email`:`$mail`, `password`:`$pass`, `userId`: `$randId` }");
       $_SESSION['username'] = $usn;
      $_SESSION['email'] = $mail;
      $_SESSION['userid'] = $randId;
      echo "<script>window.location.assign('https://cyphit.redica.repl.co/')</script>";
    }else{
    echo "<p style='color:red;'>Passwords Dont Match.</p>";
    }
  }
}

?>
     </center>

  </body>
</html>
<script>
  function Check(event){
    var uname = document.getElementById('uname').value;
    var enchar = uname.charAt(uname.length - 1);
    var blocked = [' ', '!', '2', '#', '$', '%', '^', '&', '*', '(', ')', '+', '~', '`', '/','\\','*','-','|','>',',','?','=','[',']','{','}','<',';',':',"'",'"','@'];
    if(blocked.includes(event.data)){
      var newuname = uname.replaceAll(event.data, "")
      document.getElementById('uname').value = newuname
    }
  }
</script>