<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find User • CyphIt</title>
    <link rel='stylesheet' href='https://cyphit.redica.repl.co/designs/style.css'>
    <link rel='icon' href='https://cyphit.redica.repl.co/designs/logo.png'>
  </head>
  <body>
    <br>
    <br>
    <center>
    <div class='frm-ct'>
    <form method='post'>
      <label>UserId</label>
      <input type='text' name='uidd' placeholder='Enter Userid'>
      <br>
      <button name='find'>Find</button>
    </form>
    </div>
      <?php 
if(isset($_POST['find'])){
  $uid = $_POST['uidd'];
  echo "<script>window.location.assign('https://cyphit.redica.repl.co/user?id=$uid')</script>";
}
?>
  <a class='almx bbc' href='https://cyphit.redica.repl.co/'>Go Home</a>
    </center>
    
  </body>
</html>