<?php 
session_start();
require_once("../jsdb/jsdb-conn.php");
$jsdb = new Jsdb();
$LINusername = "";
$LINemail = "";
$LINuserid = "";
if(isset($_SESSION['username']) and isset($_SESSION['email']) and isset($_SESSION['userid'])){
  $LINusername = $_SESSION['username'];
  $LINemail = $_SESSION['email'];
  $LINuserid = $_SESSION['userid'];
}else{
  echo "<script>window.location.assign('https://cyphit.redica.repl.co/login')</script>";
}

?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>CyphIt • <?php echo $LINusername; // • ?></title>
    <link rel='stylesheet' href='https://cyphit.redica.repl.co/designs/style.css'>
    <link rel='icon' href='https://cyphit.redica.repl.co/designs/logo.png'>
  </head>
  <body>
    <br>
    <br>
    <Center>
    <p class='hone'>Take a photo</p>
      <a class='almx bbc' href='https://cyphit.redica.repl.co/'>Go Home</a><br>
      <br>
      <video id="video" width="320" height="240" style='width:320px;height:240px;border-style:solid;' autoplay="">
      </video>
      <img src='' id="iip" style='width:320px;height:240px;border-style:solid;display:none;'>
      <br>
      <br>
<div id='insn'>
  <p>Select a camera below to take a picture.</p>
      <select id='select'>
        <option value="" selected="selected">Select your option</option>
      </select>      
      <button id='button'>Select</button>
</div>
      <div id='iign' style='display: none;'>
        <a class='almx' href='https://cyphit.redica.repl.co/take'>Wrong Camera</a>
        <br>
        <br>
        <button class='master' id='click-photo'> Click</button>
      </div>
      <div id='mysn' style='display:none;'>
        <button class='master' onclick="encode()">Approve</button>
        <br>
        <a class='almx' href='https://cyphit.redica.repl.co/take' style='background-color: red;'>Cancel</a>
      </div>
      <div id='mygn' style='display:none;'>
        <form method='post'>
          <button class='master' name='upl'>Upload</button>
          <br>
        <a class='almx' href='https://cyphit.redica.repl.co/take' style='background-color: red;'>Cancel</a>
        <input type='hidden' id='mymn' name='mmnu'><br>
        <input type='hidden' id='mymp' name='mmpu'><br>
        <input type='hidden' id='myms' name='mmsu'><br>
        
        </form>
      </div>
      <canvas id='canvas'  width="320" height="240" style='display:none;width:320px;height:240px;'></canvas>
    </Center>
    <script src='https://cyphit.redica.repl.co/designs/stegano.js'></script>
  </body>
<?php 
if(isset($_POST['upl'])){
  $filcode = $_POST['mmnu'];//file code
  $place = $_POST['mmpu'];//file location
  $encryp = $_POST['mmsu'];//file encryption
  $filePath = "../EncFiles/$place.enc";
  $mkfl = fopen($filePath, 'w') or die("Error");
  fwrite($mkfl, $filcode);
  fclose($mkfl);
  $jsdb->add_row('../jsdb/databases/encfiles', "{`userId`:`$LINuserid`, `imgId`:`$place`, `EncStr`:`$encryp`}");
  echo "<script>window.location.assign('https://cyphit.redica.repl.co')</script>";
}
?>
</html>
<script>
var TTMZ;
  
     const video = document.getElementById('video');
const button = document.getElementById('button');
const select = document.getElementById('select');

function gotDevices(mediaDevices) {
  select.innerHTML = '';
  select.appendChild(document.createElement('option'));
  let count = 1;
  mediaDevices.forEach(mediaDevice => {
    if (mediaDevice.kind === 'videoinput') {
      const option = document.createElement('option');
      option.value = mediaDevice.deviceId;
      const label = mediaDevice.label || `Camera ${count++}`;
      const textNode = document.createTextNode(label);
      option.appendChild(textNode);
      select.appendChild(option);
    }
  });
}

button.addEventListener('click', event => {
  if (typeof currentStream !== 'undefined') {
    stopMediaTracks(currentStream);
  }
  const videoConstraints = {};
  if (select.value === '') {
    videoConstraints.facingMode = 'environment';
  } else {
    videoConstraints.deviceId = { exact: select.value };
  }
  const constraints = {
    video: videoConstraints,
    audio: false
  };

  navigator.mediaDevices
    .getUserMedia(constraints)
    .then(stream => {
      currentStream = stream;
      video.srcObject = stream;
      return navigator.mediaDevices.enumerateDevices();
    })
    .then(gotDevices)
    .catch(error => {
      console.error(error);
    });
  document.getElementById('insn').style.display = "none";
  document.getElementById('iign').style.display = "block";
});

navigator.mediaDevices.enumerateDevices().then(gotDevices);
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");
  click_button.addEventListener('click', function() {
   	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
   	let image_data_url = canvas.toDataURL('image/jpeg');
document.getElementById('iip').src = image_data_url
    console.log(image_data_url)
    document.getElementById('video').style.display ='none'
    document.getElementById('iip').style.display ='block'
  document.getElementById('iign').style.display = "none";
    document.getElementById('mysn').style.display = "block";
  TTMZ = image_data_url
    
});
  var sax;
  function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * 
 charactersLength));
   }
   return result;
}
  function encode(){
    var strid = makeid(64);
    var nam = makeid(40);
    var mmbc = steg.encode(strid, TTMZ)
    console.log("ENCODED B64:")
    console.log(mmbc)
    document.getElementById('mymn').value = mmbc;
    document.getElementById('mymp').value = nam;
    document.getElementById('myms').value = strid;
    document.getElementById('mysn').style.display = "none";
    document.getElementById('mygn').style.display = "block";
    
  }

    
</script>