<?php 
session_start();
require_once("../jsdb/jsdb-conn.php");
$jsdb = new Jsdb();
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login • CyphIt</title>
    <link rel='stylesheet' href='https://cyphit.redica.repl.co/designs/style.css'>
    <link rel='icon' href='https://cyphit.redica.repl.co/designs/logo.png'>
  </head>
  <body>
    <br>
    <br>
     <center>
       <img src='https://cyphit.redica.repl.co/designs/logo.png' style='width:150px;height:150px;' draggable='false'>
       <h3>CyphIt Login</h3>
       <div class='frm-ct'>
         
         <form method='post'>
           <label>Username</label><br>
           <input type='text' name='ussn' placeholder='Enter Username'><br>
           <label>Password</label><br>
           
           <input type='password' name='psw' placeholder='Enter Password'><br>
           <button name='logn'>Login</button>
           <br>
           <br>
           <label>Don't have an account? <a href='https://cyphit.redica.repl.co/register' style='text-decoration:none;'>Register</a></label>
         </form>
         <a class='almx bbc' href='https://cyphit.redica.repl.co/nouser'>Service Page</a>
       </div>
       <?php 
if(isset($_POST['logn'])){
  $usn = $jsdb->safe($_POST['ussn']);
  $pass = $jsdb->safe(hash('sha256',$_POST['psw']));
  $row = $jsdb->get_row('../jsdb/databases/users', "{`username`:`$usn`, `password`:`$pass`}");
  if(count($row) == 1){
    $_SESSION['username'] = $row[0]['username'];
    $_SESSION['email'] = $row[0]['email'];
    $_SESSION['userid'] = $row[0]['userId'];
    echo "<script>window.location.assign('https://cyphit.redica.repl.co/')</script>";
  }
  else if(count($row) == 0){
    echo "<p style='color:red;'>Username or Password must be wrong, no user was found</p>";
  }else{
    echo "<p style='color:red;'>Account might be corrupted due to a twin account attack.</p>"; 
  }
}

?>
     </center>

  </body>
</html>